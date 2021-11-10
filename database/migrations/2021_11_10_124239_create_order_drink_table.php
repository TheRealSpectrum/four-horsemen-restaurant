<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateOrderDrinkTable extends Migration
{
    public function up()
    {
        Schema::create("order_drink", function (Blueprint $table) {
            $table->foreignId("order_id")->constrained();
            $table->foreignId("drink_id")->constrained();
            $table->integer("amount");
        });
    }

    public function down()
    {
        Schema::dropIfExists("order_drink");
    }
}
