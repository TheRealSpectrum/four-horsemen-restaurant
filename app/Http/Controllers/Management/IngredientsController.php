<?php

namespace App\Http\Controllers\Management;

use App\Models\GlobalUnit;
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
                return $ingredient->purchasePriceAsString() .
                    " / {$ingredient->purchase_price_per}{$ingredient->globalUnit->name}";
            });

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("global_unit_id", "unit", "Unit", function (
                Ingredient $ingredient
            ) {
                return $ingredient->globalUnit->name;
            })
            ->defineFieldLeft("stored", "number", "Stock")
            ->defineFieldLeft("stored_min", "number", "Desired Stock")
            ->defineFieldLeft("purchase_price", "number", "Purchase Price")
            ->defineFieldLeft(
                "purchase_price_per",
                "number",
                "Purchase Price Per"
            );

        $builder
            ->defineChangerStore("name", ["required"])
            ->defineChangerStore("global_unit_id", [
                "required",
                "numeric",
                "min:1",
            ])
            ->defineChangerStore("stored", ["required", "numeric", "min:0"])
            ->defineChangerStore("stored_min", ["required", "numeric", "min:0"])
            ->defineChangerStore("purchase_price", [
                "required",
                "numeric",
                "min:0",
            ])
            ->defineChangerStore("purchase_price_per", [
                "required",
                "numeric",
                "min:0",
            ]);

        $builder
            ->defineChangerUpdate("name", ["filled"])
            ->defineChangerUpdate("global_unit_id", [
                "filled",
                "numeric",
                "min:1",
            ])
            ->defineChangerUpdate("stored", ["filled", "numeric", "min:0"])
            ->defineChangerUpdate("stored_min", ["filled", "numeric", "min:0"])
            ->defineChangerUpdate("purchase_price", [
                "filled",
                "numeric",
                "min:0",
            ])
            ->defineChangerUpdate("purchase_price_per", [
                "filled",
                "numeric",
                "min:0",
            ]);
    }

    protected string $managementModel = Ingredient::class;
    protected string $managementName = "ingredients";
    protected string $managementParameterName = "ingredient";
}
