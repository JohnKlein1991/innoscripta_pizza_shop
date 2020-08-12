<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pizza
 * @package App\Models
 * @property integer id
 * @property string title
 * @property string description
 * @property integer price
 */
class Pizza extends Model
{
    /**
     * @var string
     */
    protected $table = 'pizzas';
}
