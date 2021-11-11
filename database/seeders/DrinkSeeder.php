<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Seeder;

class DrinkSeeder extends Seeder
{
    public function run(): void
    {
        Drink::factory()->create([
            "name" => "White Wine",
            "price" => 5000,
            "alcohol_content" => 10,
            "category_id" => 2,
        ]);
        Drink::factory()->create([
            "name" => "Red Wine",
            "price" => 5500,
            "alcohol_content" => 11,
            "category_id" => 2,
        ]);
        Drink::factory()->create([
            "name" => "Beer",
            "price" => 600,
            "alcohol_content" => 6,
            "category_id" => 1,
        ]);
        Drink::factory()->create([
            "name" => "White Beer",
            "price" => 600,
            "alcohol_content" => 5,
            "category_id" => 1,
        ]);
    }
}
