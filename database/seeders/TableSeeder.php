<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Table, Reservation};

final class TableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = Table::factory()
            ->count(10)
            ->create();

        Reservation::factory()
            ->count(50)
            ->create()
            ->each(function (Reservation $reservation) use ($tables) {
                $reservation->tables()->attach($tables->random());
            });

        Reservation::factory()
            ->count(10)
            ->beforeNow()
            ->create()
            ->each(function (Reservation $reservation) use ($tables) {
                $reservation->tables()->attach($tables->random());
            });
    }
}
