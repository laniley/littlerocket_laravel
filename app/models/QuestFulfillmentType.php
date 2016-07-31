<?php

class QuestFulfillmentType extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quest_fulfillment_types';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	// protected $fillable = array('user_id', 'cannon_id', 'shield_id', 'engine_id');
}
