<?php

namespace Database\Factories;

use App\Models\GlobalUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

final class GlobalUnitFactory extends Factory
{
    protected $model = GlobalUnit::class;

    public function definition(): array
    {
        return [
            "name" => "",
        ];
    }
}
