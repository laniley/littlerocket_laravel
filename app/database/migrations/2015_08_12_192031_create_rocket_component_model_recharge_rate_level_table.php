<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocketComponentModelRechargeRateLevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rocket_component_model_recharge_rate_levels', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('level')->default(1);
			$table->integer('costs')->default(500);
			$table->integer('construction_time')->default(150);
			$table->float('recharge_rate')->default(0.1);

			$table->integer('rocketComponentModel_id')->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('rocketComponentModel_id', 'recharge_level_model_foreign')->references('id')->on('rocket_component_models');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rocket_component_model_recharge_rate_levels');
	}

}
