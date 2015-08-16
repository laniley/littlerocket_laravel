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
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('rocketComponent_id', 'rocketComponentModel_id');

  public function rocketComponent()
  {
      return $this->belongsTo('RocketComponent');
  }

  public function rocketComponentModel()
  {
      return $this->belongsTo('RocketComponentModel');
  }
}
