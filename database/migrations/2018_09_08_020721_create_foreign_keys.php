<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('forums', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('no action');
		});
        Schema::table('posts', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
        Schema::table('posts', function (Blueprint $table) {
			$table->foreign('forum_id')->references('id')->on('forums')
						->onDelete('cascade')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('forums', function(Blueprint $table) {
			$table->dropForeign('forums_category_id_foreign');
		});
        Schema::table('posts', function (Blueprint $table) {
			$table->dropForeign('threads_user_id_foreign');
		});
        Schema::table('posts', function (Blueprint $table) {
			$table->dropForeign('threads_forum_id_foreign');
		});
	}
}