<?php

class RocketComponentModelMm extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rocket_component_model_mm';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array(
		'created_at',
		'updated_at',
		'rocketComponentModelCapacityLevelMm_id',
		'rocketComponentModelRechargeRateLevelMm_id',
		'myRocketComponentModelLevelMms',
		'myRocketComponentModelCapacityLevelMms',
		'myRocketComponentModelRechargeRateLevelMms'
	);

	protected $fillable = array('rocketComponent_id', 'rocketComponentModel_id');

  public function rocketComponent()
  {
      return $this->belongsTo('RocketComponent');
  }

  public function rocketComponentModel()
  {
      return $this->belongsTo('RocketComponentModel');
  }

	public function rocketComponentModelCapacityLevelMm()
  {
      return $this->belongsTo('RocketComponentModelLevelMm');
  }

	public function rocketComponentModelRechargeRateLevelMm()
  {
      return $this->belongsTo('RocketComponentModelLevelMm');
  }

	public function myRocketComponentModelLevelMms()
  {
      return $this->hasMany('RocketComponentModelLevelMm', 'rocketComponentModelMm_id');
  }

	// public function myRocketComponentModelCapacityLevelMms()
  // {
  //     return $this->myRocketComponentModelLevelMms()->where('parent', 0)->get();;
  // }
	//
	// public function myRocketComponentModelRechargeRateLevelMms()
  // {
  //     return $this->hasMany('RocketComponentModelLevelMm', 'rocketComponentModelMm_id');
  // }
}
