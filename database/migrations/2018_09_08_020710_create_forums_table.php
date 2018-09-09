<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumsTable extends Migration {

	public function up()
	{
		Schema::create('forums', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->integer('position')->default('0');
			$table->string('name')->unique();
			$table->string('description')->nullable();
			$table->string('icon')->nullable();
			$table->integer('replies_count')->unsigned()->default('0');
			$table->timestamp('locked_at')->nullable();
			$table->integer('threads_count')->unsigned()->default('0');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('forums');
	}
}