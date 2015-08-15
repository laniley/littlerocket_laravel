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
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('user_id', 'canon_id', 'shield_id', 'engine_id');

	public function user()
  {
      return $this->belongsTo('User');
  }

  public function canon()
  {
      return $this->hasOne('RocketComponent');
  }

  public function shield()
  {
      return $this->hasOne('RocketComponent');
  }

  public function engine()
  {
      return $this->hasOne('RocketComponent');
  }
}
