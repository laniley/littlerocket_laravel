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
      'object' => 'XP'
    ));

    QuestRewardType::create(array(
      'object' => 'stars'
    ));

    QuestRewardType::create(array(
      'object' => 'energy'
    ));
  }



} // EOF
