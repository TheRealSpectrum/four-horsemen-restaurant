<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateReservationsTable extends Migration
{
    public function up(): void
    {
        Schema::create("reservations", function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->integer("guest_count");
            $table->dateTime("date_start");
            $table->dateTime("date_end");
            $table->boolean("active");
            $table->string("event_type");

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("reservations");
    }
}
