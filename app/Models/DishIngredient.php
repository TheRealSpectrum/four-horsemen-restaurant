<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class DishIngredient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["dish_id", "ingredient_id", "amount"];
}
