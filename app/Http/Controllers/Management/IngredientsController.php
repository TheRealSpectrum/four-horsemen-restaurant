<?php

namespace App\Http\Controllers\Management;

use App\Models\Ingredient;
use App\Management\Builder as ManagementBuilder;

use Illuminate\Http\Request;

final class IngredientsController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
    {
        $builder
            ->defineColumn("name", "Name", true)
            ->defineColumn("stored", "In Stock", false, function (
                Ingredient $ingredient
            ) {
                return $ingredient->storedWithUnit();
            })
            ->defineColumn("purchase_price", "Purchase Price", true, function (
                Ingredient $ingredient
            ) {
                return $ingredient->purchasePriceAsString();
            });

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("unit", "text", "unit")
            ->defineFieldLeft("stored", "number", "Stock")
            ->defineFieldLeft("stored_min", "number", "Desired Stock")
            ->defineFieldLeft("purchase_price", "number", "Purchase Price");

        $builder
            ->defineChangerStore("name", ["required"])
            ->defineChangerStore("unit", ["present"])
            ->defineChangerStore("stored", ["required", "numeric", "min:0"])
            ->defineChangerStore("stored_min", ["required", "numeric", "min:0"])
            ->defineChangerStore("purchase_price", [
                "required",
                "numeric",
                "min:0",
            ]);

        $builder
            ->defineChangerUpdate("name", ["filled"])
            ->defineChangerUpdate("unit", [])
            ->defineChangerUpdate("stored", ["filled", "numeric", "min:0"])
            ->defineChangerUpdate("stored_min", ["filled", "numeric", "min:0"])
            ->defineChangerUpdate("purchase_price", [
                "filled",
                "numeric",
                "min:0",
            ]);
    }

    protected string $managementModel = Ingredient::class;
    protected string $managementName = "ingredients";
    protected string $managementParameterName = "ingredient";
}
