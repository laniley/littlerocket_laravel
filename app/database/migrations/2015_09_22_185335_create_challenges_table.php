<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fb_request_id')->unique();
			$table->integer('from_player_id')->unsigned();
			$table->integer('to_player_id')->unsigned();
			$table->integer('from_player_score')->unsigned()->default(0);
			$table->integer('to_player_score')->unsigned()->default(0);

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('from_player_id')->references('id')->on('users');
			$table->foreign('to_player_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('challenges')) {
			Schema::drop('challenges');
		}
	}

}
