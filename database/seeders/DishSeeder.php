<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Dish, DishIngredient, Ingredient};

final class DishSeeder extends Seeder
{
    public function run(): void
    {
        $cheese = Ingredient::factory()->create([
            "name" => "Cheese",
            "unit" => "g",
            "stored" => 1500,
            "stored_min" => 3000,
            "purchase_price" => 1000,
            "purchase_price_per" => 1000,
        ])->id;

        $milk = Ingredient::factory()->create([
            "name" => "Milk",
            "unit" => "ml",
            "stored" => 940,
            "stored_min" => 1000,
            "purchase_price" => 150,
            "purchase_price_per" => 1000,
        ])->id;
        $walnut = Ingredient::factory()->create([
            "name" => "Walnut",
            "unit" => "g",
            "stored" => 500,
            "stored_min" => 500,
            "purchase_price" => 900,
            "purchase_price_per" => 1000,
        ])->id;
        $steak = Ingredient::factory()->create([
            "name" => "Steak",
            "unit" => "",
            "stored" => 16,
            "stored_min" => 20,
            "purchase_price" => 1500,
            "purchase_price_per" => 1,
        ])->id;
        $fish = Ingredient::factory()->create([
            "name" => "Fish",
            "unit" => "",
            "stored" => 32,
            "stored_min" => 40,
            "purchase_price" => 800,
            "purchase_price_per" => 1,
        ])->id;
        $wine = Ingredient::factory()->create([
            "name" => "White Wine",
            "unit" => "l",
            "stored" => 25,
            "stored_min" => 50,
            "purchase_price" => 1150,
            "purchase_price_per" => 1,
        ])->id;
        $basil = Ingredient::factory()->create([
            "name" => "Basil",
            "unit" => "g",
            "stored" => 1000,
            "stored_min" => 2000,
            "purchase_price" => 2500,
            "purchase_price_per" => 500,
        ])->id;
        $pinenut = Ingredient::factory()->create([
            "name" => "Pine nut",
            "unit" => "g",
            "stored" => 2000,
            "stored_min" => 2000,
            "purchase_price" => 3200,
            "purchase_price_per" => 1000,
        ])->id;
        $egg = Ingredient::factory()->create([
            "name" => "Egg",
            "unit" => "",
            "stored" => 200,
            "stored_min" => 300,
            "purchase_price" => 50,
            "purchase_price_per" => 50,
        ])->id;
        $flour = Ingredient::factory()->create([
            "name" => "Flour",
            "unit" => "g",
            "stored" => 20,
            "stored_min" => 50,
            "purchase_price" => 30,
            "purchase_price_per" => 1000,
        ])->id;
        $thyme = Ingredient::factory()->create([
            "name" => "Thyme",
            "unit" => "g",
            "stored" => 5000,
            "stored_min" => 6500,
            "purchase_price" => 3000,
            "purchase_price_per" => 500,
        ])->id;
        $oregano = Ingredient::factory()->create([
            "name" => "Oragano",
            "unit" => "g",
            "stored" => 4000,
            "stored_min" => 5000,
            "purchase_price" => 3000,
            "purchase_price_per" => 500,
        ])->id;
        $tomato = Ingredient::factory()->create([
            "name" => "Tomato",
            "unit" => "g",
            "stored" => 2000,
            "stored_min" => 2500,
            "purchase_price" => 200,
            "purchase_price_per" => 1000,
        ])->id;

        $ingredients = Ingredient::all();

        $this->createDish(
            [
                "name" => "Pasta Pesto",
                "price" => 4499,
                "minutes_to_prepare" => 30,
            ],
            [
                [$flour, 500],
                [$basil, 400],
                [$pinenut, 200],
                [$cheese, 150],
                [$egg, 2],
            ]
        );
        $this->createDish(
            [
                "name" => "Pasta Fish",
                "price" => 2999,
                "minutes_to_prepare" => 40,
            ],
            [
                [$flour, 500],
                [$cheese, 150],
                [$fish, 1],
                [$thyme, 20],
                [$oregano, 50],
                [$basil, 80],
                [$tomato, 200],
                [$egg, 2],
            ]
        );
        $this->createDish(
            [
                "name" => "Pasta with steak",
                "price" => 4499,
                "minutes_to_prepare" => 50,
            ],
            [
                [$flour, 500],
                [$basil, 90],
                [$pinenut, 50],
                [$walnut, 80],
                [$oregano, 50],
                [$thyme, 35],
                [$steak, 1],
                [$egg, 2],
            ]
        );
    }

    private function createDish(array $attributes, array $ingredients): void
    {
        $dish = Dish::factory()->create($attributes);
        if ($dish instanceof Dish) {
            foreach ($ingredients as [$ingredient, $amount]) {
                $dish
                    ->ingredients()
                    ->attach($ingredient, ["amount" => $amount]);
            }
            return;
        }

        throw new \Exception(
            "Instance created from dish factory is not of type `Dish`"
        );
    }
}
