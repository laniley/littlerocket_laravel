<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocketComponentModelLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rocket_component_model_levels', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('level');
			$table->integer('costs')->default(500);
			$table->integer('construction_time')->default(150);
			$table->integer('value');

			$table->integer('rocketComponentModel_id')->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('rocketComponentModel_id', 'level_model_foreign')->references('id')->on('rocket_component_models');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('rocket_component_model_levels'))
		{
			Schema::drop('rocket_component_model_levels');
		}
	}

}
