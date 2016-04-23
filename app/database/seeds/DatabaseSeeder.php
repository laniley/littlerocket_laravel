<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// disable foreign key check for this connection before running seeders
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call('UserTableSeeder');
		$this->call('RocketComponentModelTableSeeder');
		$this->call('AchievementsTableSeeder');

		// enable foreign key check
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}
