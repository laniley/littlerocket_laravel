<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique()->nullable();
			$table->string('fb_id')->unique();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('img_url')->nullable();
			$table->string('gender')->nullable();
			$table->integer('score')->default(0);
			$table->integer('stars')->default(0);
			$table->integer('rank')->default(0);
			$table->integer('reached_level')->default(1);
			$table->boolean('first_login')->default(true);

			$table->dateTime('last_login')->default('0000-00-00 00:00:00');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('users'))
		{
			Schema::drop('users');
		}
	}

}
