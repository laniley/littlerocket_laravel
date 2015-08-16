<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocketComponentModelMmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rocket_component_model_mm', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('construction_start')->default(0);
			$table->string('status')->default('locked');

		  $table->integer('rocketComponent_id')->unsigned();
			$table->integer('rocketComponentModel_id')->unsigned();
			$table->integer('rocketComponentModelCapacityLevelMm_id')->unsigned()->nullable();
			$table->integer('rocketComponentModelRechargeRateLevelMm_id')->unsigned()->nullable();

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
		Schema::drop('rocket_component_model_mm');
	}

}
