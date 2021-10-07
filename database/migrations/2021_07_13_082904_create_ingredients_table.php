<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateIngredientsTable extends Migration
{
    public function up(): void
    {
        Schema::create("ingredients", function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->text("unit");
            $table->integer("stored");
            $table->integer("stored_min");
            $table->integer("purchase_price");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("ingredients");
    }
}
