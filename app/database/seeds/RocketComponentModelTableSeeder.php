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
    // Canon
    RocketComponentModel::create(array(
      'type' => 'canon',
      'model' => 1,
      'costs' => 0,
      'construction_time' => 0
    ));

    RocketComponentModel::create(array(
      'type' => 'canon',
      'model' => 2,
      'costs' => 1000,
      'construction_time' => 600
    ));

    RocketComponentModel::create(array(
      'type' => 'canon',
      'model' => 3,
      'costs' => 2000,
      'construction_time' => 1200
    ));
    // Shield
    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 1,
      'costs' => 0,
      'construction_time' => 0
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 2,
      'costs' => 2000,
      'construction_time' => 2400
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 3,
      'costs' => 2500,
      'construction_time' => 4800
    ));
    // Engine
    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 1,
      'costs' => 0,
      'construction_time' => 0
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 2,
      'costs' => 2500,
      'construction_time' => 24000
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 3,
      'costs' => 3000,
      'construction_time' => 48000
    ));
  }



} // EOF
