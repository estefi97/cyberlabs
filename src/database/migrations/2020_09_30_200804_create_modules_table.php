<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('content');
            $table->text('challenge');
            $table->enum('status', [
                \App\Module::PUBLISHED, \App\Module::DELETED])->default(\App\Module::PUBLISHED);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('module_course', function (Blueprint $table) {
           $table->unsignedInteger('module_id');
           $table->foreign('module_id')->references('id')->on('modules');
           $table->unsignedInteger('course_id');
           $table->foreign('course_id')->references('id')->on('courses');
           $table->timestamps();
           $table->softDeletes();
        });

        Schema::create('module_user', function (Blueprint $table) {
           $table->unsignedInteger('module_id');
           $table->foreign('module_id')->references('id')->on('modules');
           $table->unsignedInteger('user_id');
           $table->foreign('user_id')->references('id')->on('users');
           $table->enum('status', [
                \App\Module::MODULECOMPLETED, \App\Module::MODULEPENDING])->default(\App\Module::MODULEPENDING);
           $table->timestamps();
           $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
        Schema::dropIfExists('module_course');
        Schema::dropIfExists('module_user');
    }
}
