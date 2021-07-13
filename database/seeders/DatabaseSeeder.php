<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\DishSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([DishSeeder::class]);
    }
}
