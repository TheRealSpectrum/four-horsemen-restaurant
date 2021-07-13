<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    public function up()
    {
        Schema::create("dishes", function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->integer("price");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("dishes");
    }
}
