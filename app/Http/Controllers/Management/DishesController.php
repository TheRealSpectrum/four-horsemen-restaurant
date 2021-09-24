<?php

namespace App\Http\Controllers\Management;

use App\Models\{Dish, Ingredient};
use App\Management\Builder as ManagementBuilder;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

final class DishesController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
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
            ->defineFieldLeft(
                "ingredients",
                "ingredient",
                "Ingredients",
                null,
                function (Dish $dish) {
                    return $dish->ingredientsAsJson();
                }
            );

        $builder
            ->defineChangerStore("name", ["required"])
            ->defineChangerStore("price", ["required"])
            ->defineManyChangerStore(
                Ingredient::class,
                "ingredients",
                "ingredient",
                ["amount"]
            );

        $builder
            ->defineChangerUpdate("name", ["filled"])
            ->defineChangerUpdate("price", ["filled", "numeric", "min:0"])
            ->defineManyChangerUpdate(
                Ingredient::class,
                "ingredients",
                "ingredient",
                ["amount"]
            );
    }

    protected function queryEdit(Builder $builder): Builder
    {
        return $builder->with("ingredients");
    }

    protected string $managementModel = Dish::class;
    protected string $managementName = "dishes";
    protected string $managementParameterName = "dish";
}
