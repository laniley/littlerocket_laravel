<?php

class EnergyController extends \BaseController {

	public function index() {

		// $fb_id = Input::get('fb_id');
		// $mode = Input::get('mode');
		// $type = Input::get('type');
		//
		// $users = new User();
		//
		// $users = $users -> leftJoin('users_achievements_mm', function($join) {
		// 									$join -> on('users_achievements_mm.user_id', '=', 'users.id');
		// 									$join -> on('users_achievements_mm.unlocked', '=', DB::raw(1));
		// 								})
		// 								->leftJoin('achievements', function($join) {
		// 									$join -> on('users_achievements_mm.achievement_id', '=', 'achievements.id');
		// 								})
		// 								-> select(DB::raw('users.*, SUM(achievement_points) AS achievement_points, SUM(users_achievements_mm.updated_at) AS max_updated'))
		// 								-> groupBy('users.id');
		//
		// if(isset($fb_id)) {
		// 	$users = $users->where('fb_id', $fb_id);
		// }
	  // else if(isset($mode) && $mode == "leaderboard") {
		// 	if(isset($type) && $type == "score") {
		// 		$users = $users -> orderByRankDesc()
		// 							      -> take(50);
		// 	}
		// 	else if(isset($type) && $type == "achievements") {
		// 		$users = $users -> orderByAchievementsDesc()
		// 										-> where('unlocked', true)
		// 										-> take(50);
		// 	}
		// 	else if(isset($type) && $type == "challenges") {
		// 		$users = $users -> orderByChallengesRankDesc()
		// 							      -> take(50);
		// 	}
	  // }
		//
		// $users = $users->get();
		//
		// // if get player -> get also achievements, fb-app-requests and energy
		// if(isset($fb_id) && count($users) > 0) {
		//
		// 	$achievements = Achievement::all();
		//
		// 	foreach ($users as $user) {
		// 		// Achievements
		// 		$user->rank_by_achievement_points = $user->rankByAchievementPoints();
		// 		$achievement_ids = [];
		// 		foreach ($achievements as $achievement) {
		// 			$achievements_mm = UserAchievementMm::firstOrCreate(array(
		// 			 'user_id' => $user['id'],
		// 			 'achievement_id' => $achievement['id']
		// 			));
		// 			$achievement['id'] = $achievements_mm['id'];
		// 			$achievement['user_id'] = $user['id'];
		// 			array_push($achievement_ids, $achievements_mm['id']);
		// 		}
		// 		$user->achievements = $achievement_ids;
		// 		// fb-app-requests
		// 		$fb_app_requests = FBAppRequest::where('fb_id', $user->fb_id)->get();
		// 		$request_ids = [];
		// 		foreach($fb_app_requests as $request) {
		// 			array_push($request_ids, $request['id']);
		// 		}
		// 		$user->fb_app_requests = $request_ids;
		// 		// Energy
		// 		$energy = Energy::firstOrCreate(array(
		// 			 'user_id' => $user->id
		// 		));
		// 		// $energy->update();
		// 		$user['energy_id'] = $energy->id;
		// 	}
		//
		// 	return '{ "users": '.$users.', "achievements": '.$achievements.', "fbAppRequests": '.$fb_app_requests.' }';
		// }
		// else {
		// 	return '{ "users": '.$users.'}';
		// }
	}

	public function show($id) {
		$energy = Energy::findOrFail($id);

		$results = DB::select('select
																case when energy + new_energy < max_energy then energy + new_energy else max_energy end as new_energy,
																energy as old_energy,
																max_energy,
																seconds_left
													 from users
													 inner join (
															select
																	id,
																	user_id,
																	current as energy,
																	max as max_energy,
																	floor(time_to_sec(timediff(NOW(), last_recharge)) / 300) as new_energy,
																	time_to_sec(timediff(NOW(), last_recharge)) - (floor(time_to_sec(timediff(NOW(), last_recharge)) / 300) * 300) seconds_left
															from users_energy
													 ) as energy
																on users.id = energy.user_id
													 where energy.id='.$id.';');

		$last_recharge = time() - $results[0]->seconds_left;

		$energy->current = $results[0]->new_energy;
		$energy->last_recharge = date('Y-m-d H:i:s', $last_recharge + 7200 /* two hours */);
		$energy->save();

		return '{"userEnergy":'.$energy.' }';
	}

	public function update($id) {
		$energy = Energy::findOrFail($id);
		$energy_input = Input::get('userEnergy.current');
		$energy = $energy->calculate($energy_input);
	  return '{"userEnergy":'.$energy.' }';
	}

	public function buy($id) {
		$energy = Energy::findOrFail($id);
		$energy->user->stars -= 100;
		$energy->user->save();
		$energy->current += 1;
		$energy->save();
		return '{"userEnergy":'.$energy.', "user": '.$energy->user.' }';
	}
}
