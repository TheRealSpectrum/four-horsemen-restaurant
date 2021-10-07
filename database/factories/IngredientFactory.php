<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ingredient;

final class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition(): array
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
            "purchase_price" => $this->faker->numberBetween(1, 5) * 50,
        ];
    }
}
