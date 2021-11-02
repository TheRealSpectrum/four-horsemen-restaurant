<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            DishSeeder::class,
            TableSeeder::class,
            //ReservationSeeder::class,
        ]);
    }
}
