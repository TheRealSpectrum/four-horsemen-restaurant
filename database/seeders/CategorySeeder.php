<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;

final class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->create(["name" => "beer", "type" => "drink"]);
        Category::factory()->create(["name" => "wine", "type" => "drink"]);
        Category::factory()->create(["name" => "fish", "type" => "dish"]);
        Category::factory()->create(["name" => "beef", "type" => "dish"]);
        Category::factory()->create(["name" => "pasta", "type" => "dish"]);
    }
}
