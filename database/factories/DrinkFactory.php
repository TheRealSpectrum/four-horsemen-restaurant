<?php

namespace Database\Factories;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DrinkFactory extends Factory
{
    protected $model = Drink::class;

    public function definition()
    {
        return [
            "name" => $this->faker->word(),
            "price" => $this->faker->randomNumber(2, true) * 100,
            "purchase_price" => $this->faker->randomNumber(2, true) * 50,
            "alcohol_content" => $this->faker->numberBetween(0, 60),
            "allergies" => "",
            "category_id" => 1,
        ];
    }
}
