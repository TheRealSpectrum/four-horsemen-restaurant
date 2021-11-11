<?php

namespace App\Http\Controllers\Management;

use App\Models\{Category, Drink};
use App\Management\Builder as ManagementBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DrinksController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
    {
        $builder
            ->defineColumn("name", "Name", true)
            ->defineColumn("price", "Price", true, function (Drink $drink) {
                return $drink->priceAsString();
            })
            ->defineColumn("purchase_price", "Purchase Price", true, function (
                Drink $drink
            ) {
                return $drink->purchasePriceAsString();
            })
            ->defineColumn(
                column: "alcohol_content",
                header: "Alcohol Content",
                map: function (Drink $drink) {
                    return $drink->alcohol_content . "%";
                }
            )
            ->defineColumn(
                column: "category_id",
                header: "Category",
                map: function (Drink $drink) {
                    return $drink->category->name;
                }
            );

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("price", "number", "Price", function (
                Drink $drink
            ) {
                return $drink->priceAsString();
            })
            ->defineFieldLeft(
                "purchase_price",
                "number",
                "Purchase Price",
                function (Drink $drink) {
                    return $drink->purchasePriceAsString();
                }
            )
            ->defineFieldLeft(
                "alcohol_content",
                "number",
                "Alcohol Content",
                function (Drink $drink) {
                    return $drink->alcohol_content . "%";
                }
            )
            ->defineFieldLeft(
                column: "category_id",
                type: "select",
                label: "Category",
                map: function (Drink $drink) {
                    return $drink->category->name;
                },
                mapInput: function (Drink $drink) {
                    return str_replace(
                        "\"",
                        "'",
                        json_encode([
                            "options" => Category::where("type", "drink")
                                ->get()
                                ->map(function (Category $category) {
                                    return [
                                        "id" => $category->id,
                                        "display" => $category->name,
                                    ];
                                })
                                ->toArray(),
                            "value" => $drink->category_id,
                        ])
                    );
                }
            )
            ->defineFieldRight(
                "allergies",
                "textarea",
                "Allergy Information",
                function (Drink $drink) {
                    return $drink->allergies ?? "";
                }
            );

        $builder
            ->defineChangerStore("name", ["required"])
            ->defineChangerStore("price", ["required", "numeric", "min:1"])
            ->defineChangerStore("purchase_price", [
                "required",
                "numeric",
                "min:1",
            ])
            ->defineChangerStore("alcohol_content", [
                "required",
                "numeric",
                "min:0",
                "max:100",
            ])
            ->defineChangerStore("category_id", [
                "required",
                "numeric",
                "min:1",
            ])
            ->defineChangerStore("allergies", ["present"]);

        $builder
            ->defineChangerUpdate("name", ["filled"])
            ->defineChangerUpdate("price", ["filled", "numeric", "min:0"])
            ->defineChangerUpdate("purchase_price", [
                "filled",
                "numeric",
                "min:0",
            ])
            ->defineChangerUpdate("category_id", ["filled", "numeric", "min:1"])
            ->defineChangerUpdate("alcohol_content", [
                "filled",
                "numeric",
                "min:0",
                "max:100",
            ])
            ->defineChangerUpdate("allergies", ["present"]);
    }

    protected string $managementModel = Drink::class;
    protected string $managementName = "drinks";
    protected string $managementParameterName = "drink";
}
