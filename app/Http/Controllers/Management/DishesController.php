<?php

namespace App\Http\Controllers\Management;

use App\Models\Dish;
use App\Management\Builder;

use Illuminate\Http\Request;

final class DishesController extends ManagementController
{
    protected function managementInit(Builder $builder): void
    {
        $builder
            ->defineColumn("name", "Name")
            ->defineColumn("price", "Price", function (Dish $dish) {
                return $dish->priceAsString();
            });

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("price", "number", "Price", function (
                Dish $dish
            ) {
                return $dish->priceAsString();
            })
            ->defineFieldLeft("ingredients", "ingredient", "Ingredients");

        $builder
            ->defineChangerStore("name", ["required"])
            ->defineChangerStore("price", ["required"]);

        $builder
            ->defineChangerUpdate("name", ["filled"])
            ->defineChangerUpdate("price", ["filled", "numeric", "min:0"]);
    }

    protected string $managementModel = Dish::class;
    protected string $managementName = "dishes";
    protected string $managementParameterName = "dish";
}
