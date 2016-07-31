<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestFulfillmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quest_fulfillments', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('quest_id')->unsigned();
			$table->integer('fulfillment_type_id')->unsigned();
			$table->integer('fulfillment_amount')->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('quest_id')->references('id')->on('quests');
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
		if (Schema::hasTable('quest_fulfillments'))
		{
			Schema::drop('quest_fulfillments');
		}
	}

}
