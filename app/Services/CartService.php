<?php

namespace App\Services;

use App\Models\Pizza;

/**
 * Class CartService
 * @package App\Services
 */
class CartService
{
    /**
     * Delivery price in dollars
     */
    public const DELIVERY_PRICE = 500;
    /**
     * Session key for cart
     */
    private const SESSION_NAME = 'pizza_cart';

    /**
     * Add new pizza to cart
     * @param Pizza $pizza
     */
    public function add(Pizza $pizza)
    {
        $cartData = session(self::SESSION_NAME);

        if(!is_null($cartData)) {
            if(isset($cartData[$pizza->id])) {
                $cartData[$pizza->id] = ++$cartData[$pizza->id];
            } else {
                $cartData[$pizza->id] = 1;
            }
        } else {
            $cartData = [$pizza->id => 1];
        }
        session([self::SESSION_NAME => $cartData]);
    }

    /**
     * Set quantity for this pizza
     * @param Pizza $pizza
     * @param int $quantity
     */
    public function setQuantity(Pizza $pizza, int $quantity)
    {
        $cartData = session(self::SESSION_NAME);
        $cartData[$pizza->id] = $quantity;

        session([self::SESSION_NAME => $cartData]);
    }

    /**
     * Return all cart data
     * @return mixed
     */
    public function getData()
    {
        return session()->get(self::SESSION_NAME);
    }

    /**
     * Return total quantity of all items in the cart
     *
     * @return int
     */
    public function getTotalQuantity()
    {
        $cartData = session(self::SESSION_NAME);

        if (is_null($cartData)) {
            return 0;
        }

        $quantity = 0;
        foreach ($cartData as $item) {
            $quantity += $item;
        }

        return $quantity;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function decreaseById(int $id)
    {
        $cartData = session(self::SESSION_NAME);

        if (!isset($cartData[$id])) {
            return false;
        }

        if ((int) $cartData[$id] === 1) {
            unset($cartData[$id]);
        } else {
            $cartData[$id]--;
        }

        session([self::SESSION_NAME => $cartData]);

        return true;
    }

    /**
     * @return bool
     */
    public function clearCart()
    {
        session([self::SESSION_NAME => null]);

        return true;
    }


    /**
     * @param int $id
     * @return bool
     */
    public function removeById(int $id)
    {
        $cartData = session(self::SESSION_NAME);

        if (!isset($cartData[$id])) {
            return false;
        }

        unset($cartData[$id]);

        session([self::SESSION_NAME => $cartData]);

        return true;
    }
}
