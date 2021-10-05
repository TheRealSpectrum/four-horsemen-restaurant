<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Ingredient extends Model
{
    use HasFactory;

    public function storedWithUnit(): string
    {
        return $this->stored . $this->unit;
    }

    public function asObjectString(): string
    {
        // prettier-ignore
        return <<<JSON
        {
            id: $this->id,
            name: '$this->name',
            unit: '$this->unit'
        }
        JSON;
    }

    public function purchasePriceAsString(): string
    {
        $priceString = substr_replace(
            (string) $this->purchase_price,
            ",",
            -2,
            0
        );
        return $this->purchase_price < 100 ? "€0$priceString" : "€$priceString";
    }

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class)->using(DishIngredient::class);
    }

    protected $fillable = [
        "name",
        "unit",
        "stored",
        "stored_min",
        "purchase_price",
    ];
}
