<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('link_video');
            $table->enum('status', [
                \App\Webinar::PUBLISHED, \App\Webinar::INACTIVE])->default(\App\Webinar::PUBLISHED);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('webinar_comment', function (Blueprint $table) {
            $table->unsignedInteger('webinar_id');
            $table->foreign('webinar_id')->references('id')->on('webinars');
            $table->unsignedInteger('comment_id');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinars');
        Schema::dropIfExists('webinar_comment');
    }
}
