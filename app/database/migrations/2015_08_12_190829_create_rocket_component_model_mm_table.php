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
			$table->integer('capacity')->unsigned()->default(3);
			$table->integer('recharge_rate')->unsigned()->default(1);

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
		});

		Schema::table('rocket_components', function($table) {
			$table->foreign('selectedRocketComponentModelMm_id', 'comp_comp_model_mm_foreign')->references('id')->on('rocket_component_model_mm');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		if (Schema::hasTable('rocket_component_model_mm')) {
			Schema::drop('rocket_component_model_mm');
		}

		\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
