<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->string('picture')->nullable();
            $table->enum('status', [
                \App\Specialty::PUBLISHED, \App\Specialty::PENDING, \App\Specialty::REJECTED
            ])->default(\App\Specialty::PENDING);
            $table->boolean('previous_approved')->default(false);
            $table->boolean('previous_rejected')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('goal_specialty', function (Blueprint $table) {
            $table->unsignedInteger('goal_id');
            $table->foreign('goal_id')->references('id')->on('goals');
            $table->unsignedInteger('specialty_id');
            $table->foreign('specialty_id')->references('id')->on('specialties');
        });

        Schema::create('requirement_specialty', function (Blueprint $table) {
            $table->unsignedInteger('requirement_id');
            $table->foreign('requirement_id')->references('id')->on('requirements');
            $table->unsignedInteger('specialty_id');
            $table->foreign('specialty_id')->references('id')->on('specialties');
        });

        Schema::create('course_specialty', function (Blueprint $table) {
           $table->unsignedInteger('course_id');
           $table->foreign('course_id')->references('id')->on('courses');
           $table->unsignedInteger('specialty_id');
           $table->foreign('specialty_id')->references('id')->on('specialties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('goal_specialty');
        Schema::dropIfExists('requirement_specialty');
        Schema::dropIfExists('course_specialty');
    }
}
