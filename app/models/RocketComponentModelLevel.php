<?php

class RocketComponentModelLevel extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rocket_component_model_levels';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	public function scopeCanons($query)
  {
			return $query->where('type', '=', 'canon');
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
