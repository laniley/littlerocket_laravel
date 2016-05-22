<?php

class ArmadaMembershipRequest extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'armada_membership_requests';

	protected $fillable = array('user_id', 'armada_id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('updated_at');
}
