<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocketComponentModelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rocket_component_models', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('costs')->default(500);
			$table->integer('construction_time')->default(150);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('rocket_component_models'))
		{
			Schema::drop('rocket_component_models');
		}
	}

}
