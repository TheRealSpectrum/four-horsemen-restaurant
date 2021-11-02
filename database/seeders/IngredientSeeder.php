<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Ingredient;

final class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        Ingredient::factory()->create([
            "name" => "Cheese",
            "unit" => "g",
            "stored" => 1000,
            "stored_min" => 1000,
            "purchase_price" => 250,
            "purchase_price_per" => 1000,
            "global_unit_id" => 2,
        ]);
        Ingredient::factory()->create([
            "name" => "Milk",
            "unit" => "ml",
            "stored" => 940,
            "stored_min" => 1000,
            "purchase_price" => 150,
            "purchase_price_per" => 1000,
            "global_unit_id" => 6,
        ]);
        Ingredient::factory()->create([
            "name" => "Walnut",
            "unit" => "g",
            "stored" => 500,
            "stored_min" => 500,
            "purchase_price" => 500,
            "purchase_price_per" => 600,
            "global_unit_id" => 1,
        ]);
        Ingredient::factory()->create([
            "name" => "Steak",
            "unit" => "",
            "stored" => 16,
            "stored_min" => 20,
            "purchase_price" => 1500,
            "purchase_price_per" => 1,
            "global_unit_id" => 7,
        ]);
        Ingredient::factory()->create([
            "name" => "Fish",
            "unit" => "",
            "stored" => 32,
            "stored_min" => 40,
            "purchase_price" => 800,
            "purchase_price_per" => 1,
            "global_unit_id" => 7,
        ]);
        Ingredient::factory()->create([
            "name" => "White Wine",
            "unit" => "l",
            "stored" => 25,
            "stored_min" => 50,
            "purchase_price" => 1150,
            "purchase_price_per" => 1,
            "global_unit_id" => 5,
        ]);
        Ingredient::factory()->create([
            "name" => "Basil",
            "unit" => "g",
            "stored" => 1000,
            "stored_min" => 2000,
            "purchase_price" => 500,
            "purchase_price_per" => 500,
            "global_unit_id" => 2,
        ]);
        Ingredient::factory()->create([
            "name" => "Pine nut",
            "unit" => "g",
            "stored" => 2000,
            "stored_min" => 2000,
            "purchase_price" => 1500,
            "purchase_price_per" => 1000,
            "global_unit_id" => 2,
        ]);
        Ingredient::factory()->create([
            "name" => "Egg",
            "unit" => "",
            "stored" => 200,
            "stored_min" => 300,
            "purchase_price" => 5,
            "purchase_price_per" => 50,
            "global_unit_id" => 1,
        ]);
        Ingredient::factory()->create([
            "name" => "Flour",
            "unit" => "kg",
            "stored" => 20,
            "stored_min" => 50,
            "purchase_price" => 30,
            "purchase_price_per" => 1,
            "global_unit_id" => 4,
        ]);
        Ingredient::factory()->create([
            "name" => "Thyme",
            "unit" => "g",
            "stored" => 5000,
            "stored_min" => 6500,
            "purchase_price" => 200,
            "purchase_price_per" => 500,
            "global_unit_id" => 2,
        ]);
        Ingredient::factory()->create([
            "name" => "Oragano",
            "unit" => "g",
            "stored" => 4000,
            "stored_min" => 5000,
            "purchase_price" => 150,
            "purchase_price_per" => 500,
            "global_unit_id" => 2,
        ]);
        Ingredient::factory()->create([
            "name" => "Tomato",
            "unit" => "kg",
            "stored" => 10,
            "stored_min" => 15,
            "purchase_price" => 200,
            "purchase_price_per" => 1,
            "global_unit_id" => 4,
        ]);
    }
}
