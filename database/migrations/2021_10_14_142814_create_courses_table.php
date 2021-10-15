<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateCoursesTable extends Migration
{
    public function up(): void
    {
        Schema::create("courses", function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained();
            $table->boolean("done")->default(false);
            $table->string("type");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("courses");
    }
}
