<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateDrinksTable extends Migration
{
    public function up()
    {
        Schema::create("drinks", function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->integer("price");
            $table->integer("purchase_price");
            $table->integer("alcohol_content")->nullable();
            $table->text("allergies")->nullable();
            $table->foreignId("category_id");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("drinks");
    }
}
