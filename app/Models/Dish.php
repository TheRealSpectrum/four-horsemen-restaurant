<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Dish extends Model
{
    use HasFactory;

    public function priceAsString(): string
    {
        $priceString = substr_replace((string) $this->price, ",", -2, 0);
        return "€$priceString";
    }

    protected $fillable = ["name", "price"];
}
