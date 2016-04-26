<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array(
				'flight-achievement',
				'stars-all-time-achievement',
				'friends-achievement'
			));
			/* how many points are needed, to get that achievement? E.g. how often must the player fly? How many stars must he collect? */
			$table->integer('needed_progress_points')->unsigned();
			/* the points the player get as a reward */
			$table->integer('achievement_points')->unsigned();

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
		if (Schema::hasTable('achievements')) {
			Schema::drop('achievements');
		}
	}

}
