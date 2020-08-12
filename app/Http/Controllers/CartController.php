<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Services\CartService;
use App\Services\PizzaService;
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
     * CartController constructor.
     * @param CartService $cartService
     * @param PizzaService $pizzaService
     */
    public function __construct(CartService $cartService, PizzaService $pizzaService)
    {
        $this->cartService = $cartService;
        $this->pizzaService = $pizzaService;
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
        } else {
            $pizzas = [];
            $totalQuantity = 0;
            $totalPrice = 0;
        }

        return view('cart', [
            'pizzas' => $pizzas,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'cartData' => $cartData
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

        return response()->json([
            'success' => true,
            'total_price' => $totalPrice
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

        return response()->json([
            'success' => true
        ]);
    }
}
