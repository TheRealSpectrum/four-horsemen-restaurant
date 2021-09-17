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

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class)->using(DishIngredient::class);
    }

    protected $fillable = ["name", "unit", "stored", "stored_min"];
}
