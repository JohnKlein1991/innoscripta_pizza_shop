<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Services\CartService;
use App\Services\Currency\CurrencyService;
use App\Services\PizzaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * @var CartService
     */
    private CartService $cartService;
    /**
     * @var PizzaService
     */
    private PizzaService $pizzaService;
    /**
     * @var CurrencyService
     */
    private CurrencyService $currencyService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     * @param PizzaService $pizzaService
     * @param CurrencyService $currencyService
     */
    public function __construct(CartService $cartService, PizzaService $pizzaService, CurrencyService $currencyService)
    {
        $this->cartService = $cartService;
        $this->pizzaService = $pizzaService;
        $this->currencyService = $currencyService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cartData = $this->cartService->getData();

        if (!is_null($cartData)) {
            $pizzas = $this->pizzaService->getByIds(array_keys($cartData));
            if (is_null($pizzas)) {
                throw new HttpException(422);
            }
            $totalQuantity = $this->cartService->getTotalQuantity();
            $totalPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
            $totalPrice = sprintf("%.2f", $totalPrice/100);
        } else {
            $pizzas = [];
            $totalQuantity = 0;
            $totalPrice = 0;
        }

        $euroRate = $this->currencyService->getEuroRate();

        return view('cart', [
            'pizzas' => $pizzas,
            'total_quantity' => $totalQuantity,
            'cart_total_price' => $totalPrice,
            'delivery_price' => sprintf("%.2f", CartService::DELIVERY_PRICE/100),
            'cart_data' => $cartData,
            'euro_rate' => $euroRate
        ]);
    }

    /**
     * @param int $pizzaId
     * @return int[]|mixed
     */
    public function add(int $pizzaId)
    {
        $pizza = Pizza::find($pizzaId);
        if (is_null($pizza)) {
            throw new NotFoundHttpException('A pizza with this ID does not exist');
        }
        $this->cartService->add($pizza);

        $cartData = $this->cartService->getData();
        $totalPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
        $totalPrice = sprintf("%.2f", $totalPrice/100);

        return response()->json([
            'success' => true,
            'total_price' => $totalPrice
        ]);
    }

    /**
     * @param Request $request
     * @param int $pizzaId
     * @return int[]|mixed
     */
    public function setQuantity(Request $request, int $pizzaId)
    {
        $pizza = Pizza::find($pizzaId);
        $quantity = $request->get('quantity', null);

        if (is_null($pizza)) {
            throw new NotFoundHttpException('A pizza with this ID does not exist');
        }
        if (is_null($quantity)) {
            throw new HttpException(400, 'Parameter \'quantity\' is required');
        }

        if ((int) $quantity < 0) {
            throw new HttpException(400, 'Incorrect value for quantity');
        }

        $this->cartService->setQuantity($pizza, $quantity);

        $cartData = $this->cartService->getData();
        $totalPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
        $totalPrice = sprintf("%.2f", $totalPrice/100);
        $euroRate = $this->currencyService->getEuroRate();

        return response()->json([
            'success' => true,
            'total_price' => $totalPrice,
            'euro_rate' => $euroRate,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function decreaseItemQuantity(int $id)
    {
        if (!$this->cartService->decreaseById($id)) {
            throw new NotFoundHttpException();
        }

        return response()->json([
            'success' => true
        ]);
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItem(int $id)
    {
        if (!$this->cartService->removeById($id)) {
            throw new NotFoundHttpException();
        }

        $cartData = $this->cartService->getData();
        $totalPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
        $totalPrice = sprintf("%.2f", $totalPrice/100);

        $euroRate = $this->currencyService->getEuroRate();

        return response()->json([
            'success' => true,
            'total_price' => $totalPrice,
            'euro_rate' => $euroRate
        ]);
    }
}
