<?php

class QuestFulfillmentTypesTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'quest_fulfillment_types'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    QuestFulfillmentType::create(array(
      'action' => 'collect',
      'object' => 'stars'
    ));

    QuestFulfillmentType::create(array(
      'action' => 'spend',
      'object' => 'stars'
    ));

    QuestFulfillmentType::create(array(
      'action' => 'shoot',
      'object' => 'asteroids'
    ));
  }



} // EOF
