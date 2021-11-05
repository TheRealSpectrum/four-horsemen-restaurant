<?php

namespace App\Http\Controllers\Management;

use App\Models\{Dish, Ingredient, Category};
use App\Management\Builder as ManagementBuilder;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

final class DishesController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
    {
        $builder
            ->defineColumn("name", "Name", true)
            ->defineColumn("price", "Price", true, function (Dish $dish) {
                return $dish->priceAsString();
            })
            ->defineColumn("category_id", "Category", true, function (
                Dish $dish
            ) {
                return $dish->category->name;
            });

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("price", "number", "Price", function (
                Dish $dish
            ) {
                return $dish->priceAsString();
            })
            ->defineFieldLeft(
                "minutes_to_prepare",
                "number",
                "Minutes to Prepare"
            )
            ->defineFieldLeft(
                column: "category_id",
                type: "select",
                label: "Category",
                map: function (Dish $dish) {
                    return $dish->category->name;
                },
                mapInput: function (Dish $dish) {
                    return str_replace(
                        "\"",
                        "'",
                        json_encode([
                            "options" => Category::where("type", "dish")
                                ->get()
                                ->map(function (Category $category) {
                                    return [
                                        "id" => $category->id,
                                        "display" => $category->name,
                                    ];
                                })
                                ->toArray(),
                            "value" => $dish->category_id,
                        ])
                    );
                }
            )
            ->defineFieldLeft(
                "ingredients",
                "ingredient",
                "Ingredients",
                function (Dish $dish) {
                    return $dish->ingredientsDisplayAsJson();
                },
                function (Dish $dish) {
                    return $dish->ingredientsAsJson();
                }
            )
            ->defineFieldRight("allergies", "textarea", "Allergy Information")
            ->defineFieldRight("variations", "textarea", "Dish Variations")
            ->defineFieldRight("recipe", "textarea", "Dish Recipe");

        $builder
            ->defineChangerStore("name", ["required"])
            ->defineChangerStore("price", ["required"])
            ->defineChangerStore("minutes_to_prepare", [
                "required",
                "numeric",
                "min:1",
            ])
            ->defineChangerStore("category_id", [
                "required",
                "numeric",
                "min:1",
            ])
            ->defineChangerStore("allergies", ["present"])
            ->defineChangerStore("variations", ["present"])
            ->defineChangerStore("recipe", ["present"])
            ->defineManyChangerStore(
                Ingredient::class,
                "ingredients",
                "ingredient",
                ["amount"]
            );

        $builder
            ->defineChangerUpdate("name", ["filled"])
            ->defineChangerUpdate("price", ["filled", "numeric", "min:0"])
            ->defineChangerUpdate("minutes_to_prepare", [
                "filled",
                "numeric",
                "min:1",
            ])
            ->defineChangerUpdate("category_id", ["filled", "numeric", "min:1"])
            ->defineChangerUpdate("allergies", ["present"])
            ->defineChangerUpdate("variations", ["present"])
            ->defineChangerUpdate("recipe", ["present"])
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
