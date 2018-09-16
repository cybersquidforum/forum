<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumsTable extends Migration {

	public function up()
	{
		Schema::create('forums', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('position')->default(0);
            $table->string('name');
			$table->string('description')->nullable();
			$table->string('icon')->nullable();
            $table->unsignedInteger('replies_count')->default(0);
            $table->dateTime('locked_at')->nullable();
            $table->unsignedInteger('threads_count')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('forums');
	}
}