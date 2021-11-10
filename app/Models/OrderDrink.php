<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderDrink extends Pivot
{
    public $timestamps = false;
    protected $fillable = ["order_id", "drink_id", "amount"];
}
