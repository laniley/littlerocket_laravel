<?php

class QuestRewardsTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'quest_rewards'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    QuestRewards::create(array(
      'quest_id' => '1',
      'reward_type_id' => '1',
      'reward_amount' => 50
    ));

    QuestRewards::create(array(
      'quest_id' => '1',
      'reward_type_id' => '2',
      'reward_amount' => 20
    ));

    QuestRewards::create(array(
      'quest_id' => '2',
      'reward_type_id' => '1',
      'reward_amount' => 80
    ));

    QuestRewards::create(array(
      'quest_id' => '2',
      'reward_type_id' => '2',
      'reward_amount' => 50
    ));

    QuestRewards::create(array(
      'quest_id' => '3',
      'reward_type_id' => '1',
      'reward_amount' => 70
    ));

    QuestRewards::create(array(
      'quest_id' => '3',
      'reward_type_id' => '2',
      'reward_amount' => 70
    ));

    QuestRewards::create(array(
      'quest_id' => '4',
      'reward_type_id' => '1',
      'reward_amount' => 100
    ));

    QuestRewards::create(array(
      'quest_id' => '4',
      'reward_type_id' => '2',
      'reward_amount' => 100
    ));

    QuestRewards::create(array(
      'quest_id' => '5',
      'reward_type_id' => '1',
      'reward_amount' => 500
    ));

    QuestRewards::create(array(
      'quest_id' => '5',
      'reward_type_id' => '2',
      'reward_amount' => 500
    ));

    QuestRewards::create(array(
      'quest_id' => '5',
      'reward_type_id' => '3',
      'reward_amount' => 5
    ));

    QuestRewards::create(array(
      'quest_id' => '6',
      'reward_type_id' => '1',
      'reward_amount' => 1500
    ));

    QuestRewards::create(array(
      'quest_id' => '6',
      'reward_type_id' => '2',
      'reward_amount' => 1500
    ));

    QuestRewards::create(array(
      'quest_id' => '6',
      'reward_type_id' => '3',
      'reward_amount' => 15
    ));
  }



} // EOF
