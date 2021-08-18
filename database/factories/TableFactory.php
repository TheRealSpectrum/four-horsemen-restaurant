<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Table;

final class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition(): array
    {
        return [
            "id" => self::$number++,
            "seat_count" => $this->faker->numberBetween(1, 6),
        ];
    }

    private static $number = 1;
}
