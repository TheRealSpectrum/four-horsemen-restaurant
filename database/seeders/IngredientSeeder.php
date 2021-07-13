<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        Ingredient::factory()
            ->count(20)
            ->create();
    }
}
