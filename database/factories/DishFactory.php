<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition()
    {
        return [
            "name" => $this->faker->words(3, true),
            "price" => $this->faker->numberBetween(1, 15) * 500 - 1,
        ];
    }
}
