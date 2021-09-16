<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Dish extends Model
{
    use HasFactory;

    public function priceAsString(): string
    {
        $priceString = substr_replace((string) $this->price, ",", -2, 0);
        return "€$priceString";
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->using(
            DishIngredient::class
        );
    }

    protected $fillable = ["name", "price"];
}
