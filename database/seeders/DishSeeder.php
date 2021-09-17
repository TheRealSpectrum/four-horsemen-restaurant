<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Dish, DishIngredient, Ingredient};

final class DishSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = Ingredient::all();
        Dish::factory()
            ->count(20)
            ->create()
            ->each(function (Dish $dish) use ($ingredients) {
                $count = rand(4, 12);
                for ($i = 0; $i < $count; ++$i) {
                    $dish->ingredients()->attach($ingredients->random(), [
                        "amount" => rand(10, 20),
                    ]);
                }
            });
    }
}
