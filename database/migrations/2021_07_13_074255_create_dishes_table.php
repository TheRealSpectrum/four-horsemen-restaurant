<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateDishesTable extends Migration
{
    public function up(): void
    {
        Schema::create("dishes", function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->integer("price");
            $table->integer("minutes_to_prepare");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("dishes");
    }
}
