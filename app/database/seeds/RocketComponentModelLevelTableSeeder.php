<?php

class RocketComponentModelLevelTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'rocket_component_model_levels'; // name of the db-table
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    // Cannon-Models (1, 2, 3)
      // Cannon-Model 1
        // Capacity-Levels
        RocketComponentModelLevel::create(array(
          'type' => 'capacity',
          'level' => 1,
          'costs' => 0,
          'construction_time' => 0,
          'value' => 3,
          'rocketComponentModel_id' => 1
        ));

        RocketComponentModelLevel::create(array(
          'type' => 'capacity',
          'level' => 2,
          'costs' => 150,
          'construction_time' => 120,
          'value' => 4,
          'rocketComponentModel_id' => 1
        ));

        RocketComponentModelLevel::create(array(
          'type' => 'capacity',
          'level' => 3,
          'costs' => 200,
          'construction_time' => 240,
          'value' => 5,
          'rocketComponentModel_id' => 1
        ));

        // RechargeRate-Levels
        RocketComponentModelLevel::create(array(
          'type' => 'recharge_rate',
          'level' => 1,
          'costs' => 0,
          'construction_time' => 0,
          'value' => 1,
          'rocketComponentModel_id' => 1
        ));

        RocketComponentModelLevel::create(array(
          'type' => 'recharge_rate',
          'level' => 2,
          'costs' => 150,
          'construction_time' => 120,
          'value' => 2,
          'rocketComponentModel_id' => 1
        ));

        RocketComponentModelLevel::create(array(
          'type' => 'recharge_rate',
          'level' => 3,
          'costs' => 200,
          'construction_time' => 240,
          'value' => 3,
          'rocketComponentModel_id' => 1
        ));

    // Cannon-Model 2
      // Capacity-Levels
      RocketComponentModelLevel::create(array(
        'type' => 'capacity',
        'level' => 1,
        'costs' => 0,
        'construction_time' => 0,
        'value' => 6,
        'rocketComponentModel_id' => 2
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'capacity',
        'level' => 2,
        'costs' => 500,
        'construction_time' => 240,
        'value' => 8,
        'rocketComponentModel_id' => 2
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'capacity',
        'level' => 3,
        'costs' => 750,
        'construction_time' => 480,
        'value' => 10,
        'rocketComponentModel_id' => 2
      ));

      // RechargeRate-Levels
      RocketComponentModelLevel::create(array(
        'type' => 'recharge_rate',
        'level' => 1,
        'costs' => 0,
        'construction_time' => 0,
        'value' => 4,
        'rocketComponentModel_id' => 2
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'recharge_rate',
        'level' => 2,
        'costs' => 500,
        'construction_time' => 240,
        'value' => 5,
        'rocketComponentModel_id' => 2
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'recharge_rate',
        'level' => 3,
        'costs' => 750,
        'construction_time' => 480,
        'value' => 6,
        'rocketComponentModel_id' => 2
      ));

  // Cannon-Model 3
    // Capacity-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 12,
      'rocketComponentModel_id' => 3
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 2,
      'costs' => 750,
      'construction_time' => 480,
      'value' => 15,
      'rocketComponentModel_id' => 3
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 3,
      'costs' => 1000,
      'construction_time' => 960,
      'value' => 20,
      'rocketComponentModel_id' => 3
    ));

    // RechargeRate-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 7,
      'rocketComponentModel_id' => 3
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 2,
      'costs' => 750,
      'construction_time' => 480,
      'value' => 8,
      'rocketComponentModel_id' => 3
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 3,
      'costs' => 1000,
      'construction_time' => 960,
      'value' => 9,
      'rocketComponentModel_id' => 3
    ));

  // Shield-Models (4,5,6)
    // Shield-Model 4
      // Capacity-Levels
      RocketComponentModelLevel::create(array(
        'type' => 'capacity',
        'level' => 1,
        'costs' => 0,
        'construction_time' => 0,
        'value' => 3,
        'rocketComponentModel_id' => 4
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'capacity',
        'level' => 2,
        'costs' => 250,
        'construction_time' => 240,
        'value' => 4,
        'rocketComponentModel_id' => 4
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'capacity',
        'level' => 3,
        'costs' => 500,
        'construction_time' => 480,
        'value' => 5,
        'rocketComponentModel_id' => 4
      ));

      // RechargeRate-Levels
      RocketComponentModelLevel::create(array(
        'type' => 'recharge_rate',
        'level' => 1,
        'costs' => 0,
        'construction_time' => 0,
        'value' => 1,
        'rocketComponentModel_id' => 4
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'recharge_rate',
        'level' => 2,
        'costs' => 250,
        'construction_time' => 240,
        'value' => 2,
        'rocketComponentModel_id' => 4
      ));

      RocketComponentModelLevel::create(array(
        'type' => 'recharge_rate',
        'level' => 3,
        'costs' => 500,
        'construction_time' => 480,
        'value' => 3,
        'rocketComponentModel_id' => 4
      ));

  // Shield-Model 5
    // Capacity-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 3,
      'rocketComponentModel_id' => 5
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 2,
      'costs' => 500,
      'construction_time' => 480,
      'value' => 4,
      'rocketComponentModel_id' => 5
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 3,
      'costs' => 750,
      'construction_time' => 960,
      'value' => 5,
      'rocketComponentModel_id' => 5
    ));

    // RechargeRate-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 1,
      'rocketComponentModel_id' => 5
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 2,
      'costs' => 500,
      'construction_time' => 480,
      'value' => 2,
      'rocketComponentModel_id' => 5
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 3,
      'costs' => 750,
      'construction_time' => 960,
      'value' => 3,
      'rocketComponentModel_id' => 5
    ));

  // Shield-Model 6
    // Capacity-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 3,
      'rocketComponentModel_id' => 6
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 2,
      'costs' => 750,
      'construction_time' => 960,
      'value' => 4,
      'rocketComponentModel_id' => 6
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 3,
      'costs' => 1000,
      'construction_time' => 1920,
      'value' => 5,
      'rocketComponentModel_id' => 6
    ));

    // RechargeRate-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 1,
      'rocketComponentModel_id' => 6
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 2,
      'costs' => 750,
      'construction_time' => 960,
      'value' => 2,
      'rocketComponentModel_id' => 6
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 3,
      'costs' => 1000,
      'construction_time' => 1920,
      'value' => 3,
      'rocketComponentModel_id' => 6
    ));

// Engine-Models (7,8,9)
  // Engine-Model 7
    // Capacity-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 3,
      'rocketComponentModel_id' => 7
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 2,
      'costs' => 750,
      'construction_time' => 960,
      'value' => 4,
      'rocketComponentModel_id' => 7
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 3,
      'costs' => 1000,
      'construction_time' => 1920,
      'value' => 5,
      'rocketComponentModel_id' => 7
    ));

    // RechargeRate-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 1,
      'rocketComponentModel_id' => 7
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 2,
      'costs' => 750,
      'construction_time' => 960,
      'value' => 2,
      'rocketComponentModel_id' => 7
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 3,
      'costs' => 1000,
      'construction_time' => 1920,
      'value' => 3,
      'rocketComponentModel_id' => 7
    ));

  // Engine-Model 8
    // Capacity-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 3,
      'rocketComponentModel_id' => 8
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 2,
      'costs' => 1000,
      'construction_time' => 1920,
      'value' => 4,
      'rocketComponentModel_id' => 8
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 3,
      'costs' => 1500,
      'construction_time' => 3840,
      'value' => 5,
      'rocketComponentModel_id' => 8
    ));

    // RechargeRate-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 1,
      'rocketComponentModel_id' => 8
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 2,
      'costs' => 1000,
      'construction_time' => 1920,
      'value' => 2,
      'rocketComponentModel_id' => 8
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 3,
      'costs' => 1500,
      'construction_time' => 3840,
      'value' => 3,
      'rocketComponentModel_id' => 8
    ));

  // Engine-Model 9
    // Capacity-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 3,
      'rocketComponentModel_id' => 9
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 2,
      'costs' => 1500,
      'construction_time' => 3840,
      'value' => 4,
      'rocketComponentModel_id' => 9
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'capacity',
      'level' => 3,
      'costs' => 2000,
      'construction_time' => 7680,
      'value' => 5,
      'rocketComponentModel_id' => 9
    ));

    // RechargeRate-Levels
    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 1,
      'costs' => 0,
      'construction_time' => 0,
      'value' => 1,
      'rocketComponentModel_id' => 9
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 2,
      'costs' => 1500,
      'construction_time' => 3840,
      'value' => 2,
      'rocketComponentModel_id' => 9
    ));

    RocketComponentModelLevel::create(array(
      'type' => 'recharge_rate',
      'level' => 3,
      'costs' => 2000,
      'construction_time' => 7680,
      'value' => 3,
      'rocketComponentModel_id' => 9
    ));
  }
} // EOF
