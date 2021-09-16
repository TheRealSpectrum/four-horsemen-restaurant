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
            });
    }

    protected string $managementModel = Dish::class;
    protected string $managementName = "dishes";
    protected string $managementParameterName = "dish";
}
