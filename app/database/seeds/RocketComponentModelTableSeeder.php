<?php

class RocketComponentModelTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'rocket_component_models'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    RocketComponentModel::create(array(
      'type' => 'canon',
      'model' => 1,
      'costs' => 500,
      'construction_time' => 120
    ));

    RocketComponentModel::create(array(
      'type' => 'canon',
      'model' => 2,
      'costs' => 750,
      'construction_time' => 600
    ));

    RocketComponentModel::create(array(
      'type' => 'canon',
      'model' => 3,
      'costs' => 1000,
      'construction_time' => 1200
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 1,
      'costs' => 500,
      'construction_time' => 1200
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 2,
      'costs' => 750,
      'construction_time' => 2400
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 3,
      'costs' => 1000,
      'construction_time' => 4800
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 1,
      'costs' => 500,
      'construction_time' => 12000
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 2,
      'costs' => 750,
      'construction_time' => 24000
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 3,
      'costs' => 1000,
      'construction_time' => 48000
    ));
  }



} // EOF
