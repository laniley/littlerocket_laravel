<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocketComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rocket_components', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('costs')->default(500);
			$table->integer('construction_time')->default(150);
			$table->integer('construction_start')->default(0);
			$table->string('status')->default('locked');

			$table->integer('rocket_id')->unsigned();
			$table->integer('selectedRocketComponentModelMm_id')->nullable()->unsigned();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('rocket_id')->references('id')->on('rockets');
			$table->foreign('selectedRocketComponentModelMm_id')->references('id')->on('rocket_components');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('rocket_components'))
		{
			Schema::drop('rocket_components');
		}
	}

}
