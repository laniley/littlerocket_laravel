<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$fb_id = Input::get('fb_id');
		$mode = Input::get('mode');
		$type = Input::get('type');

		$users = new User();

		$users = $users -> leftJoin('users_achievements_mm', function($join) {
											$join -> on('users_achievements_mm.user_id', '=', 'users.id');
											$join -> on('users_achievements_mm.unlocked', '=', DB::raw(1));
										})
										->leftJoin('achievements', function($join) {
											$join -> on('users_achievements_mm.achievement_id', '=', 'achievements.id');
										})
										-> select(DB::raw('users.*, SUM(achievement_points) AS achievement_points'))
										-> groupBy('users.id');

		if(isset($fb_id)) {
			$users = $users->where('fb_id', $fb_id);
		}
	  else if(isset($mode) && $mode == "leaderboard") {
			if(isset($type) && $type == "score") {
				$users = $users -> orderByRankDesc()
									      -> take(50);
			}
			else if(isset($type) && $type == "achievements") {
				$users = $users -> orderByAchievementsDesc()
												-> where('unlocked', true)
												-> take(50);
			}
			else if(isset($type) && $type == "challenges") {
				$users = $users -> orderByChallengesRankDesc()
									      -> take(50);
			}
	  }

		$users = $users->get();

		// if get player -> get also achievements
		if(isset($fb_id) && count($users) > 0) {
			$achievements = Achievement::all();
			foreach ($users as $user) {
				$achievement_ids = [];
				foreach ($achievements as $achievement) {
					$achievements_mm = UserAchievementMm::firstOrCreate(array(
					 'user_id' => $user['id'],
					 'achievement_id' => $achievement['id']
					));
					$achievement['id'] = $achievements_mm['id'];
					$achievement['user_id'] = $user['id'];
					array_push($achievement_ids, $achievements_mm['id']);
				}
				$user->achievements = $achievement_ids;
			}

			return '{ "users": '.$users.', "achievements": '.$achievements.' }';
		}
		else {
			return '{ "users": '.$users.'}';
		}
		// foreach ($users as $user) {
		// 	$user = $this->prepareUser($user);
		// 	// if(isset($fb_id)) {
		// 	// 	$user->rank_by_won_challenges = $user->rankByWonChallenges();
		// 	// }
		// }


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$user = User::firstOrCreate(array(
		 'fb_id' => Input::get('user.fb_id')
		));

		$user->email = Input::get('user.email');
		$user->first_name = Input::get('user.first_name');
		$user->last_name = Input::get('user.last_name');
		$user->img_url = Input::get('user.img_url');
		$user->gender = Input::get('user.gender');
		$user->score = Input::get('user.score');
		$user->stars = Input::get('user.stars');
		$user->reached_level = Input::get('user.reached_level');

		$user->rank_by_score = DB::table('users')->count() + 1;

		$user->save();

		$achievements = Achievement::all();
		$achievement_ids = [];
		foreach ($achievements as $achievement) {
			$achievements_mm = UserAchievementMm::firstOrCreate(array(
			 'user_id' => $user->id,
			 'achievement_id' => $achievement['id']
			));
			$achievement['id'] = $achievements_mm['id'];
			$achievement['user_id'] = $user->id;
			array_push($achievement_ids, $achievements_mm['id']);
		}

		$user->achievements = $achievement_ids;

	  return '{"user":'.$user.', "achievements": '.$achievements.'}';
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$user = User::findOrFail($id);
		$user->email = Input::get('user.email');
		$user->img_url = Input::get('user.img_url');
		$user->gender = Input::get('user.gender');
		$user->score = Input::get('user.score');
		$user->stars = Input::get('user.stars');
		$user->stars_all_time = Input::get('user.stars_all_time');
		$user->flights = Input::get('user.flights');
		$user->reached_level = Input::get('user.reached_level');
		$user->experience = Input::get('user.experience');
		$user->first_login = false;

		$user->save();

		$this->updateRanks();

		$user = new User();
		$user = $user->select('id', 'fb_id', 'email', 'img_url', 'gender', 'first_name', 'last_name', 'rank_by_score', 'reached_level', 'experience');
		$user = $user->where('id', $id);
		$user = $user->first();



		// $user = $this->prepareUser($user);
		// $user->rank_by_won_challenges = $user->rankByWonChallenges();

	  return '{"user":'.$user.' }';
	}

	private function prepareUser($user) {
		if($user) {
			$user->rank = $user->rank();

			// $challenges = Challenge::ofUser($user)->get();
			//
			// $challengesIds = [];
			// foreach($challenges as $challenge) {
			// 	array_push($challengesIds, $challenge->id);
			// }
			// $user["challenges"] = $challengesIds;
		}

		return $user;
	}

	private function getAchievements($user) {
		if($user) {
			$user->achievements = $user->achievements();
		}

		return $user;
	}

	private function updateRanks() {
		DB::statement(DB::raw('set @row:=0'));

		DB::statement(DB::raw('update users users_a
		inner join (select id, @row:=@row+1 as rank_by_score, updated_at from users order by score desc, stars desc) users_b
			on users_a.id = users_b.id
	 	set users_a.rank_by_score = users_b.rank_by_score, users_a.updated_at = users_b.updated_at;'));
	}

}
