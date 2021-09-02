<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateTablesTable extends Migration
{
    public function up(): void
    {
        Schema::create("tables", function (Blueprint $table) {
            $table->unsignedBigInteger("id");
            $table->primary("id");

            $table->integer("seat_count");

            $table->boolean("active")->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tables");
    }
}
