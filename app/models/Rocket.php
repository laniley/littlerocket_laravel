<?php

class Rocket extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rockets';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at', 'cannon', 'shield', 'engine');

	protected $fillable = array('user_id', 'cannon_id', 'shield_id', 'engine_id');

	public function user()
  {
      return $this->belongsTo('User');
  }

	public function rocketComponents()
	{
		return $this->hasMany('RocketComponent');
	}
}
