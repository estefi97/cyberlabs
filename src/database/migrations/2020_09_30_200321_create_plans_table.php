<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('prize');
            $table->enum('status', [
                \App\Plan::PUBLISHED, \App\Plan::DELETED])->default(\App\Article::PUBLISHED);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('plan_feature', function (Blueprint $table) {
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->unsignedInteger('feature_id');
            $table->foreign('feature_id')->references('id')->on('features');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
        Schema::dropIfExists('features');
        Schema::dropIfExists('plan_feature');
    }
}
