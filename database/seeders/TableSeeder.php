<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Table, Reservation};

final class TableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = Table::factory()
            ->count(12)
            ->create();
        $startAtIndex = 0;

        $reservationCallback = function (
            Reservation $reservation,
            int $index
        ) use ($tables, &$startAtIndex) {
            $reservation
                ->tables()
                ->attach($tables[($index + $startAtIndex) % 10]);
        };

        $reservationAndActivateCallback = function (
            Reservation $reservation,
            int $index
        ) use ($tables, &$startAtIndex) {
            $reservation
                ->tables()
                ->attach($tables[($index + $startAtIndex) % 10]);
            $tables[($index + $startAtIndex) % 10]->active = true;
            $tables[($index + $startAtIndex) % 10]->save();
        };

        Reservation::factory()
            ->count(50)
            ->create()
            ->each($reservationCallback);

        Reservation::factory()
            ->count(20)
            ->todayAfterOneHour()
            ->create()
            ->each($reservationCallback);

        Reservation::factory()
            ->count(10)
            ->withinOneHour()
            ->create()
            ->each($reservationCallback);

        Reservation::factory()
            ->count(8)
            ->beforeNow()
            ->create()
            ->each($reservationAndActivateCallback);

        $startAtIndex = 8;

        Reservation::factory()
            ->count(2)
            ->beforeNow()
            ->tooLate()
            ->create()
            ->each($reservationCallback);
    }
}
