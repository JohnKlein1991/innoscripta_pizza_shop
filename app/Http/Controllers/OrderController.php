<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PizzaService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private OrderService $orderService;
    /**
     * @var CartService
     */
    private CartService $cartService;
    /**
     * @var PizzaService
     */
    private PizzaService $pizzaService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     * @param CartService $cartService
     * @param PizzaService $pizzaService
     */
    public function __construct(OrderService $orderService, CartService $cartService, PizzaService $pizzaService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
        $this->pizzaService = $pizzaService;
    }

    public function index()
    {
        $cartData = $this->cartService->getData();

        if (!is_null($cartData)) {
            $totalPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
            $totalPrice = sprintf("%.2f", $totalPrice/100);
        } else {
            $totalPrice = 0;
        }

        return view('orders', [
            'cart_total_price' => $totalPrice,
        ]);
    }

    /**
     * @param CreateOrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateOrderRequest $request)
    {
        $request->validated();

        $cartData = $this->cartService->getData();

        if (is_null($cartData)) {
            throw new HttpException(422, 'Your cart is empty');
        }

        $itemsPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
        $user = Auth::user();
        if (!$this->orderService->create($user, $cartData, $request, $itemsPrice)) {
            throw new HttpException(500);
        }
        $this->cartService->clearCart();

        session()->flash('success', 'You ordered pizzas successfully');

        return redirect()->route('main');
    }


}
