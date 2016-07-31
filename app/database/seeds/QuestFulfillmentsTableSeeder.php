<?php

class QuestFulfillmentsTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'quest_fulfillments'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    QuestFulfillments::create(array(
      'quest_id' => '1',
      'fulfillment_type_id' => '1',
      'fulfillment_amount' => 5
    ));

    QuestFulfillments::create(array(
      'quest_id' => '2',
      'fulfillment_type_id' => '1',
      'fulfillment_amount' => 20
    ));

    QuestFulfillments::create(array(
      'quest_id' => '3',
      'fulfillment_type_id' => '1',
      'fulfillment_amount' => 50
    ));

    QuestFulfillments::create(array(
      'quest_id' => '4',
      'fulfillment_type_id' => '1',
      'fulfillment_amount' => 100
    ));

    QuestFulfillments::create(array(
      'quest_id' => '5',
      'fulfillment_type_id' => '1',
      'fulfillment_amount' => 500
    ));

    QuestFulfillments::create(array(
      'quest_id' => '6',
      'fulfillment_type_id' => '1',
      'fulfillment_amount' => 1000
    ));
  }



} // EOF
