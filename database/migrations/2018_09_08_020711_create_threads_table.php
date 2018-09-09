<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateThreadsTable extends Migration {

	public function up()
	{
		Schema::create('threads', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('forum_id')->unsigned();
			$table->boolean('thread_id')->default(false);
			$table->string('title');
			$table->text('body');
			$table->integer('replies_count')->unsigned()->default('0');
			$table->integer('visits')->unsigned()->default('0');
			$table->enum('status', array('sticky', 'locked', 'pinned', 'redirect'));
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('threads');
	}
}