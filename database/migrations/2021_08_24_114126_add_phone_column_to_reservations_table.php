<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneColumnToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("reservations", function (Blueprint $table) {
            $table
                ->string("phone")
                ->nullable()
                ->default(null);
            $table
                ->text("notes")
                ->nullable()
                ->default(null);
            $table
                ->string("name")
                ->nullable()
                ->default(null)
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("reservations", function (Blueprint $table) {
            $table->dropColumn("phone", "notes");
        });
    }
}
