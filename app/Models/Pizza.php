<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pizza
 * @package App\Models
 * @property string title
 * @property string description
 */
class Pizza extends Model
{
    /**
     * @var string
     */
    protected $table = 'pizzas';
}
