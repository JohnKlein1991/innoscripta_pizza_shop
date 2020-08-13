<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property string name
 * @property string surname
 * @property string phone
 * @property string address
 */
class Order extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * Owner of the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Pizzas in the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_to_order')->wherePivot('quantity');
    }
}
