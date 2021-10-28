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
        return $this->price < 100 ? "€0$priceString" : "€$priceString";
    }

    public function ingredientsAsJson(): string
    {
        $result = "[";

        foreach ($this->ingredients as $ingredient) {
            // prettier-ignore
            $result .= <<<JSON
                    {
                        id: $ingredient->id,
                        amount: {$ingredient->pivot->amount},
                    },
                    JSON;
        }

        return substr($result, 0, -1) . "]";
    }

    public function ingredientsDisplayAsJson(): string
    {
        $result = "";
        $totalPrice = 0;

        foreach ($this->ingredients as $ingredient) {
            $currentPriceString = substr_replace(
                (string) round(
                    ($ingredient->pivot->amount * $ingredient->purchase_price) /
                        $ingredient->purchase_price_per
                ),
                ",",
                -2,
                0
            );
            $currentPriceString =
                ($ingredient->pivot->amount * $ingredient->purchase_price) /
                    $ingredient->purchase_price_per <
                100
                    ? "€0$currentPriceString"
                    : "€$currentPriceString";
            // prettier-ignore
            $result .= <<<JSON
                    {
                        name: '{$ingredient->name}',
                        amount: '{$ingredient->pivot->amount}{$ingredient->unit}',
                        purchasePrice: '$currentPriceString'
                    },
                    JSON;
            $totalPrice += round(
                ($ingredient->pivot->amount * $ingredient->purchase_price) /
                    $ingredient->purchase_price_per
            );
        }

        $priceString = substr_replace((string) $totalPrice, ",", -2, 0);
        $priceString = $totalPrice < 100 ? "€0$priceString" : "€$priceString";

        $result =
            "{totalPurchasePrice: '$priceString', ingredients: [" . $result;

        return substr($result, 0, -1) . "]}";
    }

    public function setAllergiesAttribute($value = null)
    {
        $this->attributes["allergies"] = is_null($value) ? "" : $value;
    }

    public function setVariationsAttribute($value = null)
    {
        $this->attributes["variations"] = is_null($value) ? "" : $value;
    }

    public function setRecipeAttribute($value = null)
    {
        $this->attributes["recipe"] = is_null($value) ? "" : $value;
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot("amount")
            ->using(DishIngredient::class);
    }

    protected $fillable = [
        "name",
        "price",
        "minutes_to_prepare",
        "allergies",
        "variations",
        "recipe",
    ];
}
