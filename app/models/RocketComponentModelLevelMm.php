<?php

class RocketComponentModelLevelMm extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rocket_component_model_level_mm';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('rocketComponentModelMm_id', 'rocketComponentModelLevel_id');

  public function rocketComponentModelMm()
  {
      return $this->hasOne('RocketComponentModelMm');
  }

  public function rocketComponentModelLevel()
  {
      return $this->belongsTo('RocketComponentModelLevel');
  }
}
