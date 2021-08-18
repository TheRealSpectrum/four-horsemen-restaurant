<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateReservationTablesTable extends Migration
{
    public function up(): void
    {
        Schema::create("reservation_tables", function (Blueprint $table) {
            $table->unsignedBigInteger("reservation_id");
            $table->unsignedBigInteger("table_id");

            $table
                ->foreign("reservation_id")
                ->references("id")
                ->on("reservations");

            $table
                ->foreign("table_id")
                ->references("id")
                ->on("tables");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("reservation_tables");
    }
}
