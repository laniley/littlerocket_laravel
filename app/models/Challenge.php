<?php

class Challenge extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'challenges';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	protected $fillable = array('fb_request_id', 'from_player_id', 'to_player_id');

	public function from_player_id()
  {
      return $this->belongsTo('User');
  }

  public function to_player_id()
  {
      return $this->belongsTo('User');
  }

	public function scopeOfUser($query, $user)
	{
	  $query = $query->where('from_player_id', $user->id)->orWhere('to_player_id', $user->id);
		return $query;
	}

	public function scopeWonByUser($query, $user)
	{
		$query = $query->where(function($query) {
												$query->where('from_player_id', $user->id)
															->where('from_player_score', ' > ', 'to_player_score');
										})
									 ->orWhere(function($query) {
							 					$query->where('to_player_id', $user->id)
							 								->where('to_player_score', ' > ', 'from_player_score');
										});
		return $query;
	}
}
