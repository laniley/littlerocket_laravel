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

			$table->string('fb_request_id')->unique();
			$table->string('type')->nullable();
			$table->string('fb_id')->unique()->nullable();
			$table->integer('armada_id')->unsigned()->nullable();

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('armada_id')->references('id')->on('armadas');

			$table->unique(['fb_id', 'armada_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fb_apprequests');
	}

}
