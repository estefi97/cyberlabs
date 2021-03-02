<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->string('picture')->nullable();
            $table->enum('status', [
                \App\Article::PUBLISHED, \App\Article::DELETED])->default(\App\Article::PUBLISHED);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('article_user', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->enum('status', [
                \App\Comment::PUBLISHED, \App\Comment::DELETED])->default(\App\Comment::PUBLISHED);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('comment_user', function (Blueprint $table) {
            $table->unsignedInteger('comment_id');
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('article_comment', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->unsignedInteger('comment_id');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_user');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('comment_user');
        Schema::dropIfExists('article_comment');
    }
}
