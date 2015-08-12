<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToRocketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rockets', function($table)
		{
			$table->foreign('user_id', 'rocket_user_foreign')->references('id')->on('users');
			$table->foreign('canon_id', 'rocket_canon_foreign')->references('id')->on('rocket_components')->onDelete('cascade');
			$table->foreign('shield_id', 'rocket_shield_foreign')->references('id')->on('rocket_components')->onDelete('cascade');
			$table->foreign('engine_id', 'rocket_engine_foreign')->references('id')->on('rocket_components')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('rockets'))
		{
			Schema::table('rockets', function($table)
			{
				$table->dropForeign('rocket_user_foreign');
				$table->dropForeign('rocket_canon_foreign');
				$table->dropForeign('rocket_shield_foreign');
				$table->dropForeign('rocket_engine_foreign');
			});
		}
	}

}
