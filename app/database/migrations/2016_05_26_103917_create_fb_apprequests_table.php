<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbApprequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fb_apprequests', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('fb_request_id');
			$table->string('type')->nullable();
			$table->integer('from_user_id')->unsigned()->nullable();
			$table->integer('to_user_id')->unsigned()->nullable();
			$table->string('fb_id')->nullable();
			$table->integer('armada_id')->unsigned()->nullable();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('from_user_id')->references('id')->on('users');
			$table->foreign('to_user_id')->references('id')->on('users');
			$table->foreign('armada_id')->references('id')->on('armadas');

			$table->unique(['fb_id', 'armada_id']);
			$table->unique(['fb_id', 'fb_request_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('fb_apprequests'))
		{
			Schema::drop('fb_apprequests');
		}
	}

}
