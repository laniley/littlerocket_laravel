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
			$table->integer('model');
			$table->integer('costs')->default(500);
			$table->integer('construction_time')->default(150);
			$table->string('description');
			$table->boolean('is_active')->default(0);

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
		\DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		if (Schema::hasTable('rocket_component_models'))
		{
			Schema::drop('rocket_component_models');
		}

		\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
