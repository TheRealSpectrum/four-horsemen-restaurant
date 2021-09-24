<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Dish;

final class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->words(3, true),
            "price" => $this->faker->numberBetween(1, 15) * 500 - 1,
            "minutes_to_prepare" => 30,
        ];
    }
}
