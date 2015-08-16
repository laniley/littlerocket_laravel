<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocketComponentModelLevelMmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rocket_component_model_level_mm', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('construction_start')->default(0);
			$table->string('status')->default('locked');

			$table->integer('rocketComponentModelMm_id')->unsigned();
			$table->integer('rocketComponentModelLevel_id')->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('rocketComponentModelMm_id', 'level_mm_model_mm_foreign')->references('id')->on('rocket_component_model_mm');
			$table->foreign('rocketComponentModelLevel_id', 'level_mm_level_foreign')->references('id')->on('rocket_component_model_levels');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('rocket_component_model_level_mm'))
		{
			Schema::drop('rocket_component_model_level_mm');
		}
	}

}