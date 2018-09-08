<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('language')->default('en');
			$table->string('password');
			$table->integer('reputation')->unsigned()->default('0');
			$table->boolean('is_activated')->default(false);
			$table->rememberToken('rememberToken');
			$table->datetime('last_seen')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}