<?php

class Energy extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_energy';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('user_id');

	public function user() {
      return $this->belongsTo('User');
  }


}
