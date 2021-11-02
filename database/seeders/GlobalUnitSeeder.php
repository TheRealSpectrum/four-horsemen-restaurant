<?php

namespace Database\Seeders;

use App\Models\GlobalUnit;
use Illuminate\Database\Seeder;

final class GlobalUnitSeeder extends Seeder
{
    public function run(): void
    {
        $unitStrings = ["", "g", "mg", "kg", "l", "ml", "pieces"];
        foreach ($unitStrings as $unitString) {
            GlobalUnit::factory()->create([
                "name" => $unitString,
            ]);
        }
    }
}
