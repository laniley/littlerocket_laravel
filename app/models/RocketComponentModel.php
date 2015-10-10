<?php

class RocketComponentModel extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rocket_component_models';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at', 'levels');

	public function levels()
  {
      return $this->hasMany('RocketComponentModelLevel', 'rocketComponentModel_id');
  }

	public function scopeCannons($query)
  {
			return $query->where('type', '=', 'cannon');
  }

  public function scopeShields($query)
  {
			return $query->where('type', '=', 'shield');
  }

  public function scopeEngines($query)
  {
			return $query->where('type', '=', 'engine');
  }
}
