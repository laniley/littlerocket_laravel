<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToRocketComponentModelMm extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rocket_component_model_mm', function($table)
		{
			$table->foreign('rocketComponent_id', 'comp_model_mm_comp_foreign')->references('id')->on('rocket_components');
			$table->foreign('rocketComponentModel_id', 'comp_model_mm_comp_model_foreign')->references('id')->on('rocket_component_models');
			$table->foreign('rocketComponentModelCapacityLevelMm_id', 'comp_model_mm_cap_foreign')->references('id')->on('rocket_component_model_capacity_level_mm');
			$table->foreign('rocketComponentModelRechargeRateLevelMm_id', 'comp_model_mm_recharge_foreign')->references('id')->on('rocket_component_model_recharge_rate_level_mm');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rocket_component_model_mm', function($table)
		{
			$table->dropForeign('comp_model_mm_comp_foreign');
			$table->dropForeign('comp_model_mm_comp_model_foreign');
			$table->dropForeign('comp_model_mm_cap_foreign');
			$table->dropForeign('comp_model_mm_recharge_foreign');
		});
	}

}
