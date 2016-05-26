<?php

class FBAppRequest extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fb_apprequests';

	protected $fillable = array('fb_request_id', 'type', 'fb_id', 'armada_id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('updated_at');
}
