<?php

class QuestRewardTypesTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'quest_reward_types'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    QuestRewardType::create(array(
      'name' => 'stars'
    ));

    QuestRewardType::create(array(
      'name' => 'XP'
    ));
  }



} // EOF
