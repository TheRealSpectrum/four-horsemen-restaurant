<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\{DishIngredient, Dish, Ingredient};

final class DishIngredientFactory extends Factory
{
    protected $model = DishIngredient::class;

    public function definition(): array
    {
        return [
            "dish_id" => Dish::factory(),
            "ingredient_id" => Ingredient::factory(),
            "amount" => $this->faker->numberBetween(10, 20),
        ];
    }

    public function oneDish(?Dish $optionalDish = null)
    {
        $dish = $optionalDish ?? Dish::factory()->create();
        return $this->state(function (array $attributes) use ($dish) {
            return [
                "dish_id" => $dish->id,
            ];
        });
    }

    public function oneIngredient(?Ingredient $optionalIngredient = null)
    {
        $ingredient = $optionalIngredient ?? Ingredient::factory()->create();
        return $this->state(function (array $attributes) use ($ingredient) {
            return [
                "ingredient_id" => $ingredient->id,
            ];
        });
    }

    public function existingDish()
    {
        return $this->state(function (array $attributes) {
            return [
                "dish_id" => Dish::inRandomOrder()->first()->id,
            ];
        });
    }

    public function existingIngredient()
    {
        return $this->state(function (array $attributes) {
            return [
                "ingredient_id" => Ingredient::inRandomOrder()->first()->id,
            ];
        });
    }
}
