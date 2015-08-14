<?php

class Lab extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'labs';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('user_id', 'costs', 'construction_time', 'construction_start', 'status');

	public function user()
  {
      return $this->belongsTo('User');
  }
}
