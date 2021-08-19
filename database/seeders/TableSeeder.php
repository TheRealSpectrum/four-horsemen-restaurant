<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Table, Reservation};

final class TableSeeder extends Seeder
{
    public function run(): void
    {
        Table::factory()
            ->count(10)
            ->has(Reservation::factory()->count(5))
            ->create();
    }
}
