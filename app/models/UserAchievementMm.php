<?php

class UserAchievementMm extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_achievements_mm';

	protected $fillable = array('user_id', 'achievement_id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	// protected $fillable = array('user_id', 'cannon_id', 'shield_id', 'engine_id');
}
