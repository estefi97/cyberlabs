<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('rating');
	        $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('review_course', function (Blueprint $table) {
            $table->unsignedInteger('review_id');
            $table->foreign('review_id')->references('id')->on('reviews');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('review_course');
    }
}
