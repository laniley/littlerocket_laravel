<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->foreign('lab_id', 'user_lab_foreign')->references('id')->on('labs');
			$table->foreign('rocket_id', 'rocket_lab_foreign')->references('id')->on('rockets');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			if (Schema::hasTable('users'))
			{
				$table->dropForeign('user_lab_foreign');
				$table->dropForeign('rocket_lab_foreign');
			}
		});
	}

}
