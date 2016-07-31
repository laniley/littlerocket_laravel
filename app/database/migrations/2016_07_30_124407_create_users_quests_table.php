<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersQuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_quests', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id')->unsigned();
			$table->integer('quest_id')->unsigned();

			$table->integer('current_amount')->unsigned();

			//$table->boolean('reward_has_been_collected')->default(false);

			$table->timestamp('completed_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('quest_id')->references('id')->on('quests');

			$table->unique(['user_id', 'quest_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('users_quests'))
		{
			Schema::drop('users_quests');
		}
	}

}
