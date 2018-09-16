<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use \Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	public function up()
	{
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('language')->default('en');
                $table->string('password');
                $table->unsignedSmallInteger('reputation')->default(0);
                $table->dateTime('email_confirmed_at')->nullable();
                $table->dateTime('banned_until')->nullable();
                $table->datetime('last_seen')->nullable();
                $table->unsignedTinyInteger('level')->default(1);
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->string('language')->default('en');
                $table->unsignedSmallInteger('reputation')->default(0);
                $table->dateTime('email_confirmed_at')->nullable();
                $table->dateTime('banned_until')->nullable();
                $table->datetime('last_seen')->nullable();
                $table->unsignedTinyInteger('level')->default(1);
                $table->softDeletes();
            });
        }

	}

	public function down()
	{
		Schema::drop('users');
	}
}