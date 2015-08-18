<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'lab', 'rocket');

	protected $fillable = array('email', 'fb_id', 'first_name', 'last_name', 'img_url', 'gender');

	public function lab()
  {
      return $this->hasOne('Lab');
  }

	public function rocket()
  {
      return $this->hasOne('Rocket');
  }

	public function rank() {

		DB::statement(DB::raw('set @row:=0'));

		$results = DB::select('select * from (select id, @row:=@row+1 as rank from users order by score desc, stars desc) as ranks	where id='.$this->attributes['id'].';');

		return $results[0]->rank;
	}

	public function scopeOrderByRankDesc($query)
	{
	  $query = $query->orderBy('score','DESC');
		$query = $query->orderBy('stars','DESC');
		$query = $query->orderBy('created_at','ASC');
		return $query;
	}
}
