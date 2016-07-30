<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quests', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');
			$table->string('description');

			$table->integer('parent_id')->unsigned();

			$table->integer('fulfillment_amount')->unsigned();
			$table->integer('fulfillment_type_id')->unsigned();

			$table->integer('reward_amount')->unsigned();
			$table->integer('reward_type_id')->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('parent_id')->references('id')->on('quests');
			$table->foreign('reward_type_id')->references('id')->on('quest_reward_types');
			$table->foreign('fulfillment_type_id')->references('id')->on('quest_fulfillment_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quests');
	}

}
