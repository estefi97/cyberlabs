<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('goal');
            $table->timestamps();
        });

        Schema::create('goal_course', function (Blueprint $table) {
            $table->unsignedInteger('goal_id');
            $table->foreign('goal_id')->references('id')->on('goals');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
        Schema::dropIfExists('goal_course');
    }
}
