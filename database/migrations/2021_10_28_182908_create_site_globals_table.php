<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateSiteGlobalsTable extends Migration
{
    public function up(): void
    {
        Schema::create("site_globals", function (Blueprint $table) {
            $table->id();

            $table->integer("markup_dishes")->default(3);
            $table->integer("markup_drinks")->default(2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("site_globals");
    }
}
