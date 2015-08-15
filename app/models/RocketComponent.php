<?php

class RocketComponent extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rocket_components';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('rocket_id', 'selectedRocketComponentModelMm');

	public function rocket()
  {
      return $this->belongsTo('Rocket');
  }

  public function selectedRocketComponentModelMm()
  {
      return $this->hasOne('RocketComponentModelMm');
  }

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
