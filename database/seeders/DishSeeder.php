<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Dish, DishIngredient};

class DishSeeder extends Seeder
{
    public function run()
    {
        Dish::factory()
            ->count(20)
            ->create()
            ->each(function (Dish $dish) {
                DishIngredient::factory()
                    ->count(rand(4, 12))
                    ->oneDish($dish)
                    ->existingIngredient()
                    ->create();
            });
    }
}
