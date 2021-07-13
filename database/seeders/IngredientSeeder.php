<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Ingredient;

final class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        Ingredient::factory()
            ->count(20)
            ->create();
    }
}
