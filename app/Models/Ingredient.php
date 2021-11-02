<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, BelongsTo};

final class Ingredient extends Model
{
    use HasFactory;

    public function storedWithUnit(): string
    {
        return $this->stored . $this->globalUnit->name;
    }

    public function asObjectString(): string
    {
        $purchasePrice = $this->purchase_price / $this->purchase_price_per;

        // prettier-ignore
        return <<<JSON
        {
            id: $this->id,
            name: '$this->name',
            unit: '{$this->globalUnit->name}',
            purchasePrice: $purchasePrice
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

    public function globalUnit(): BelongsTo
    {
        return $this->belongsTo(GlobalUnit::class);
    }

    protected $fillable = [
        "name",
        "unit",
        "stored",
        "stored_min",
        "purchase_price",
        "purchase_price_per",
        "global_unit_id",
    ];
}
