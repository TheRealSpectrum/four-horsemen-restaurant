<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishIngredientsTable extends Migration
{
    public function up()
    {
        Schema::create("dish_ingredients", function (Blueprint $table) {
            $table->id();
            $table->foreignId("dish_id")->contrained();
            $table->foreignId("ingredient_id")->contrained();
            $table->integer("amount");
        });
    }

    public function down()
    {
        Schema::dropIfExists("dish_ingredients");
    }
}
