<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Services\CartService;
use App\Services\PizzaService;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
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
     * MainController constructor.
     * @param CartService $cartService
     * @param PizzaService $pizzaService
     */
    public function __construct(CartService $cartService, PizzaService $pizzaService)
    {
        $this->cartService = $cartService;
        $this->pizzaService = $pizzaService;
    }

    /**
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $pizzas = Pizza::all();

        $cartData = $this->cartService->getData();

        if (!is_null($cartData)) {
            $cartItemsQuantity = $this->cartService->getTotalQuantity();
            $cartTotalPrice = $this->pizzaService->getTotalPriceByIdsAndQuantity($cartData);
        } else {
            $cartItemsQuantity = 0;
            $cartTotalPrice = 0;
        }

        return view('main', [
            'pizzas' => $pizzas,
            'cartItemsQuantity' => $cartItemsQuantity,
            'cart_total_price' => $cartTotalPrice
        ]);
    }
}
