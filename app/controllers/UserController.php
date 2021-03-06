<?php

class UserController extends \BaseController {

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
										-> select(DB::raw('users.*, SUM(achievement_points) AS achievement_points, SUM(users_achievements_mm.updated_at) AS max_updated'))
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

		// if get player -> get also achievements, fb-app-requests and energy
		if(isset($fb_id) && count($users) > 0) {
			if(isset($mode) && $mode == "me") {
				$achievements = Achievement::all();

				foreach ($users as $user) {
					// Achievements
					$user->rank_by_achievement_points = $user->rankByAchievementPoints();
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
					// messages
					$messages = Message::where('to_user_id', $user->id)->get();
					$message_ids = [];
					foreach($messages as $message) {
						array_push($message_ids, $message['id']);
					}
					$user->messages_received = $message_ids;
					// fb-app-requests
					$fb_app_requests = FBAppRequest::where('fb_id', $user->fb_id)->get();
					$request_ids = [];
					foreach($fb_app_requests as $request) {
						array_push($request_ids, $request['id']);
						$request["to_user_id"] = $user->id;
					}
					$user->fb_app_requests_received = $request_ids;
					// Energy
					$energy = Energy::firstOrCreate(array(
						 'user_id' => $user->id
					));
					$user['energy_id'] = $energy->id;
				}

				return '{ "users": '.$users.', "achievements": '.$achievements.', "fbAppRequests": '.$fb_app_requests.', "messages": '.$messages.' }';
			}
			else {
				return '{ "users": '.$users.'}';
			}
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

	public function store() {
		$user = User::firstOrCreate(array(
		 'fb_id' => Input::get('user.fb_id')
		));

		$user->email = Input::get('user.email');
		$user->first_name = Input::get('user.first_name');
		$user->last_name = Input::get('user.last_name');
		$user->gender = Input::get('user.gender');
		$user->score = Input::get('user.score');
		$user->stars = Input::get('user.stars');
		$user->reached_level = Input::get('user.reached_level');

		$count = DB::table('users')->count() + 1;

		$user->rank_by_score = $count;

		$user->save();

		$user->rank_by_achievement_points = $count;

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

		// Energy
		$energy = Energy::firstOrCreate(array(
			 'user_id' => $user->id
		));
		$user['energy_id'] = $energy->id;

	  return '{"user":'.$user.', "achievements": '.$achievements.'}';
	}

	public function show($id) {
		$user = User::findOrFail($id);
		return '{"user":'.$user.' }';
	}

	public function update($id) {
		$user = User::findOrFail($id);

		$old_armada_id = $user->armada_id;

		$user->email = Input::get('user.email');
		$user->gender = Input::get('user.gender');
		$user->score = Input::get('user.score');
		$user->stars = Input::get('user.stars');
		$user->stars_all_time = Input::get('user.stars_all_time');
		$user->flights = Input::get('user.flights');
		$user->reached_level = Input::get('user.reached_level');
		$user->experience = Input::get('user.experience');
		$user->first_login = false;

		/* user not yet in an armada OR user is leaving an armada */
		/* changing an armada is not allowed */
		if($user->armada_id == null || Input::get('user.armada_id') == null) {
			/* if user wants to join an armada */
			/* check, if there is an empty place in the armada. Not more than 20 members are allowed. */
			if(Input::get('user.armada_id') != null) {
				$armada = Armada::findOrFail(Input::get('user.armada_id'));
				if($armada->numberOfMembers() < 20) {
					$user->armada_id = Input::get('user.armada_id');
				}
			}
			/* if user is leaving an armada */
			else {
				$user->armada_id = Input::get('user.armada_id');
			}
		}

		$user->armada_rank = Input::get('user.armada_rank');

		$user->save();

		$this->updateRanks();

		$user = new User();
		$user = $user->select(
			'id',
			'fb_id',
			'email',
			'img_url',
			'gender',
			'first_name',
			'last_name',
			'rank_by_score',
			'reached_level',
			'armada_id',
			'armada_rank'
		);
		$user = $user->where('id', $id);
		$user = $user->first();

		$user->rank_by_achievement_points = $user->rankByAchievementPoints();

		if($old_armada_id) {
			$armada = Armada::findOrFail($old_armada_id);
			$count = $armada->numberOfMembers();
			if($count == 0) {
				$armada->delete();
			}
		}

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
