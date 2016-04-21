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
	protected $hidden = array(
		'password',
		'remember_token',
		'lab',
		'rocket'
	);

	protected $fillable = array(
		'email',
		'fb_id',
		'first_name',
		'last_name',
		'img_url',
		'gender',
		'rank'
	);

	public function lab() {
      return $this->hasOne('Lab');
  }

	public function rocket() {
      return $this->hasOne('Rocket');
  }

	public function rankByWonChallenges() {

		DB::statement(DB::raw('set @row:=0'));

		$results = DB::select('select * from (
														select id, @row:=@row+1 as rankByWonChallenges from
															(select users.id,
																 SUM(
																			CASE
																				 WHEN challenges.from_player_id = users.id
																							 AND challenges.from_player_score > challenges.to_player_score
																							 AND challenges.to_player_score > 0
																							 THEN 1
																				 WHEN challenges.to_player_id = users.id
																							 AND challenges.to_player_score > challenges.from_player_score
																							 AND challenges.from_player_score > 0
																							 THEN 1
																				 ELSE	0
																			 END
																 ) AS challenges_won
															from users
																left join challenges
																	on users.id = challenges.from_player_id or users.id = challenges.to_player_id
															group by users.id
														  order by challenges_won desc
														) as ranks
													) as sorted_ranks
													where id='.$this->attributes['id'].';');

		return $results[0]->rankByWonChallenges;
	}

	public function rankByAchievementPoints() {

		DB::statement(DB::raw('set @row:=0'));

		$results = DB::select('select * from (
														select id, @row:=@row+1 as rankByAchievementPoints from (
															select users.id, SUM(achievement_points) AS achievement_points, SUM(users_achievements_mm.updated_at) AS max_updated
															from users
																left join users_achievements_mm
																	on users.id = users_achievements_mm.user_id
																left join achievements
																	on users_achievements_mm.achievement_id = achievements.id
															where unlocked=1
															group by users.id
															order by achievement_points desc, max_updated asc
														) as ranks
													) as sorted_ranks	where id='.$this->attributes['id'].';');

		if(isset($results[0])) {
			return $results[0]->rankByAchievementPoints;
		}
		else {
			return DB::table('users')->count() + 1;
		}
	}

	public function scopeOrderByRankDesc($query) {
	  $query = $query->orderBy('score','DESC');
		$query = $query->orderBy('stars','DESC');
		$query = $query->orderBy('created_at','DESC');
		return $query;
	}

	public function scopeOrderByAchievementsDesc($query) {
		$query = $query -> orderBy('achievement_points', 'desc');
		$query = $query -> orderBy('max_updated','asc');
		return $query;
	}

	public function scopeOrderByChallengesRankDesc($query) {
	  $query = $query	->leftJoin('challenges', function ($join) {
					            $join->on('challenges.from_player_id', '=', 'users.id')
													 ->orOn('challenges.to_player_id', '=', 'users.id');
					         })
									 ->select(DB::raw(
												 'users.id, users.fb_id, users.first_name, users.last_name,
												 	SUM(
															 CASE
																	WHEN challenges.from_player_id = users.id
																				AND challenges.from_player_score > challenges.to_player_score
																				AND challenges.to_player_score > 0
																				THEN 1
																	WHEN challenges.to_player_id = users.id
																				AND challenges.to_player_score > challenges.from_player_score
																				AND challenges.from_player_score > 0
																				THEN 1
																	ELSE	0
																END
													) AS challenges_won'
									))
									->whereNotNull('users.id')
									->groupBy('users.id', 'users.fb_id', 'users.first_name', 'users.last_name')
									->having('challenges_won', ' > ', '0')
									->orderBy('challenges_won', 'DESC');
	}
}
