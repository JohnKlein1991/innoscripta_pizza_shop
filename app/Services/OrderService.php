<?php


namespace App\Services;


use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService
{
    /**
     * @param User|null $user
     * @param array|null $cartData
     * @param CreateOrderRequest $request
     * @param int $itemsPrice
     * @return bool
     */
    public function create(?User $user, ?array $cartData, CreateOrderRequest $request, int $itemsPrice)
    {
        try {
            DB::beginTransaction();

            $order = new Order();

            if (!is_null($user)) {
                $order->user_id = $user->id;
            }

            $order->name = $request->get('first_name');
            $order->surname = $request->get('last_name');
            $order->phone = $request->get('phone');
            $order->address = $request->get('address');

            $order->price = $itemsPrice + CartService::DELIVERY_PRICE;

            $order->save();

            foreach ($cartData as $pizzaId => $pizzaQuantity) {
                $order->pizzas()->attach($pizzaId, ['quantity' => $pizzaQuantity]);
            }

            $order->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
