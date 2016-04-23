<?php

class AchievementsTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'achievements'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();
    // Cannon
    Achievement::create(array(
      'type' => 'flight-achievement',
      'needed_progress_points' => 1,
      'achievement_points' => 1
    ));

    Achievement::create(array(
      'type' => 'flight-achievement',
      'needed_progress_points' => 10,
      'achievement_points' => 5
    ));

    Achievement::create(array(
      'type' => 'flight-achievement',
      'needed_progress_points' => 100,
      'achievement_points' => 10
    ));

    Achievement::create(array(
      'type' => 'flight-achievement',
      'needed_progress_points' => 1000,
      'achievement_points' => 25
    ));

    Achievement::create(array(
      'type' => 'flight-achievement',
      'needed_progress_points' => 5000,
      'achievement_points' => 50
    ));

    Achievement::create(array(
      'type' => 'stars-all-time-achievement',
      'needed_progress_points' => 10,
      'achievement_points' => 1
    ));

    Achievement::create(array(
      'type' => 'stars-all-time-achievement',
      'needed_progress_points' => 100,
      'achievement_points' => 5
    ));

    Achievement::create(array(
      'type' => 'stars-all-time-achievement',
      'needed_progress_points' => 1000,
      'achievement_points' => 10
    ));

    Achievement::create(array(
      'type' => 'stars-all-time-achievement',
      'needed_progress_points' => 10000,
      'achievement_points' => 25
    ));

    Achievement::create(array(
      'type' => 'stars-all-time-achievement',
      'needed_progress_points' => 100000,
      'achievement_points' => 50
    ));

    Achievement::create(array(
      'type' => 'friends-achievement',
      'needed_progress_points' => 1,
      'achievement_points' => 5
    ));

    Achievement::create(array(
      'type' => 'friends-achievement',
      'needed_progress_points' => 5,
      'achievement_points' => 10
    ));

    Achievement::create(array(
      'type' => 'friends-achievement',
      'needed_progress_points' => 10,
      'achievement_points' => 25
    ));

    Achievement::create(array(
      'type' => 'friends-achievement',
      'needed_progress_points' => 25,
      'achievement_points' => 50
    ));

    Achievement::create(array(
      'type' => 'friends-achievement',
      'needed_progress_points' => 50,
      'achievement_points' => 100
    ));
  }



} // EOF
