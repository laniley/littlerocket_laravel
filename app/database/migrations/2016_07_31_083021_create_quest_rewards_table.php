<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestRewardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quest_rewards', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('quest_id')->unsigned();
			$table->integer('reward_type_id')->unsigned();
			$table->integer('reward_amount')->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('quest_id')->references('id')->on('quests');
			$table->foreign('reward_type_id')->references('id')->on('quest_reward_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quest_rewards');
	}

}
