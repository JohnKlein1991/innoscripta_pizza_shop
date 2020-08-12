<?php


namespace App\Services;


use App\Models\Pizza;

/**
 * Class PizzaService
 * @package App\Services
 */
class PizzaService
{

    /**
     * Return list of pizzas by array of ids
     *
     * @param array $ids
     * @return array|null
     */
    public function getByIds(array $ids)
    {
        return Pizza::find($ids);
    }

    /**
     * Get total price of all items in the cart
     *
     * @param array $data
     * @return float|int
     */
    public function getTotalPriceByIdsAndQuantity(array $data)
    {
        $totalPrice = 0;

        foreach ($data as $id => $quantity) {
            $pizzaPrice = (int) Pizza::findOrFail($id)->price;
            $totalPrice += $pizzaPrice * $quantity;
        }

        return sprintf("%.2f", $totalPrice/100);
    }
}
