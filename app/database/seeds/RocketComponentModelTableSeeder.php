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
    // Cannon
    RocketComponentModel::create(array(
      'type' => 'cannon',
      'model' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'description' => 'This is the default cannon. It shoots 1 bullet at a time.',
      'is_active' => 1
    ));

    RocketComponentModel::create(array(
      'type' => 'cannon',
      'model' => 2,
      'costs' => 1000,
      'construction_time' => 600,
      'description' => 'This cannon shoots bullets in a wide range in front of the rocket.',
      'is_active' => 1
    ));

    RocketComponentModel::create(array(
      'type' => 'cannon',
      'model' => 3,
      'costs' => 2500,
      'construction_time' => 6000,
      'description' => 'This cannon shoots missiles with an automatic target search system.',
      'is_active' => 0
    ));

    RocketComponentModel::create(array(
      'type' => 'cannon',
      'model' => 4,
      'costs' => 5000,
      'construction_time' => 60000,
      'description' => 'This cannon shoots a laserbeam, which destroys everything in its way.',
      'is_active' => 0
    ));
    // Shield
    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'description' => 'This is the default shield.',
      'is_active' => 1
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 2,
      'costs' => 2000,
      'construction_time' => 2400,
      'description' => 'This shield can restore it charges.',
      'is_active' => 0
    ));

    RocketComponentModel::create(array(
      'type' => 'shield',
      'model' => 3,
      'costs' => 2500,
      'construction_time' => 4800,
      'description' => 'This shield restores it charges 2x faster.',
      'is_active' => 0
    ));
    // Engine
    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'description' => 'This is the default engine.',
      'is_active' => 1
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 2,
      'costs' => 2500,
      'construction_time' => 24000,
      'description' => 'This engine restores it charges.',
      'is_active' => 0
    ));

    RocketComponentModel::create(array(
      'type' => 'engine',
      'model' => 3,
      'costs' => 3000,
      'construction_time' => 48000,
      'description' => 'This engine restores it charges 2x faster.',
      'is_active' => 0
    ));
  }



} // EOF
