<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveOrderIdAndAddCourseIdToOrderDishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("order_dishes", function (Blueprint $table) {
            $table->dropConstrainedForeignId("order_id");
            $table->foreignId("course_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("order_dishes", function (Blueprint $table) {
            $table->foreignId("order_id")->constrained();
            $table->dropConstrainedForeignId("course_id");
        });
    }
}
