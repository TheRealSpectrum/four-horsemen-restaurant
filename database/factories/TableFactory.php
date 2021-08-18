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
            "id" => 0,
            "seat_count" => $this->faker->numberBetween(1, 6),
        ];
    }

    public function configure(): self
    {
        $number = 1;
        return $this->afterMaking(function (Table $table) use (&$number) {
            $table->id = $number++;
        });
    }
}
