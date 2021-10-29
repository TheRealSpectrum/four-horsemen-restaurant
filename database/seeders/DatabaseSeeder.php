<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GlobalUnitSeeder::class,
            UserSeeder::class,
            DishSeeder::class,
            TableSeeder::class,
            //ReservationSeeder::class,
        ]);
    }
}
