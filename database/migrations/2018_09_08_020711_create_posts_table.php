<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('forum_id');
            $table->unsignedInteger('thread_id')->nullable();
            $table->string('title')->nullable();
            $table->text('content');
            $table->unsignedInteger('replies_count')->default(0);
            $table->unsignedInteger('visits')->default(0);
            $table->dateTime('locked_at')->nullable();
            $table->dateTime('pinned_at')->nullable();
            $table->dateTime('locked_at')->nullable();
            $table->dateTime('sticky_at')->nullable();
            $table->string('redirect_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('threads');
    }
}