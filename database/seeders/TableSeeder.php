<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Table;

final class TableSeeder extends Seeder
{
    public function run(): void
    {
        Table::factory()
            ->count(30)
            ->create();
    }
}
