<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class DishIngredient extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["dish_id", "ingredient_id", "amount"];
}
