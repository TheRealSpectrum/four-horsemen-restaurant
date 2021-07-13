<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition()
    {
        return [
            "name" => $this->faker->word(1),
            "unit" => $this->faker->randomElement([
                "g",
                "kg",
                "ml",
                "l",
                "",
                "",
                "",
            ]),
            "stored" => $this->faker->numberBetween(0, 100),
            "stored_min" => $this->faker->numberBetween(50, 100),
        ];
    }
}
