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

            $table
                ->string("name")
                ->nullable()
                ->default(null);
            $table->integer("guest_count");
            $table->dateTime("date_start");
            $table->dateTime("date_end");
            $table->boolean("active");
            $table->boolean("canceled")->default(false);
            $table->string("event_type")->nullable();
            $table
                ->string("phone_number")
                ->nullable()
                ->default(null);
            $table->text("notes")->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("reservations");
    }
}
