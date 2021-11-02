<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class AddGlobalUnitIdColumnToIngredients extends Migration
{
    public function up(): void
    {
        Schema::table("ingredients", function (Blueprint $table) {
            $table
                ->foreignId("global_unit_id")
                ->nullable()
                ->constrained();

            $table->dropColumn("unit");
        });
    }

    public function down(): void
    {
        Schema::table("ingredients", function (Blueprint $table) {
            $table->dropConstrainedForeignId("global_unit_id");
            $table->text("unit");
        });
    }
}
