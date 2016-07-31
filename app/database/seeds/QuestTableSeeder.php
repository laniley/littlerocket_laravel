<?php

class QuestTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'quests'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    Quest::create(array());

    Quest::create(array(
      'parent_id' => 1
    ));

    Quest::create(array(
      'parent_id' => 2
    ));

    Quest::create(array(
      'parent_id' => 3
    ));

    Quest::create(array(
      'parent_id' => 4
    ));

    Quest::create(array(
      'parent_id' => 5
    ));
  }



} // EOF
