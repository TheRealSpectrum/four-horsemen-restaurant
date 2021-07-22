<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

final class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            "name" => "Admin",
            "email" => "admin@example.com",
        ]);
    }
}
