<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if(Input::has('fb_id')) {
	   	$fb_id = Input::get('fb_id');

			$user = User::where('fb_id', '=', $fb_id)->first();

			$user = $this->prepareUser($user);

		  return '{ "users": ['.$user.'] }';
	  }
		else if(Input::has('mode') && Input::get('mode') == "leaderboard") {

			if(Input::get('type') == "score") {
				$users = User::orderByRankDesc()
									->take(50)
									->get();
			}
			else if(Input::get('type') == "challenges") {
				$users = User::orderByChallengesRankDesc()
									->take(50)
									->get();
			}

			foreach ($users as $user)
			{
				$user = $this->prepareUser($user);
			}

		  return '{ "users": '.$users.' }';
	  }
	  else {
			$users = User::all();

			foreach ($users as $user)
			{
				$user = $this->prepareUser($user);
			}

			return '{ "users": '.$users.' }';
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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

		$user->save();

		$user = $this->prepareUser($user);

	  return '{"user":'.$user.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		$user = $this->prepareUser($user);
		return '{"user":'.$user.' }';
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);
		$user->email = Input::get('user.email');
		$user->img_url = Input::get('user.img_url');
		$user->gender = Input::get('user.gender');
		$user->score = Input::get('user.score');
		$user->stars = Input::get('user.stars');
		$user->reached_level = Input::get('user.reached_level');
		$user->experience = Input::get('user.experience');
		$user->first_login = false;

		$user->save();

		$user = $this->prepareUser($user);

		$userResponse = array(
			'id' => $user->id,
			'rank' => $user->rank
		);

	  return '{"user":'.json_encode($userResponse).' }';
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	private function prepareUser($user)
	{
		if($user) {
			$user->rank = $user->rank();
			$user->rank_by_won_challenges = $user->rankByWonChallenges();

			if($user->lab) {
					$user->lab_id = $user->lab->id;
			}

			if($user->rocket) {
					$user->rocket_id = $user->rocket->id;
			}

			if($user->challenges) {
					$user->rocket_id = $user->rocket->id;
			}

			$challenges = Challenge::ofUser($user)->get();

			$challengesIds = [];
			foreach($challenges as $challenge) {
				array_push($challengesIds, $challenge->id);
			}
			$user["challenges"] = $challengesIds;
		}

		return $user;
	}

}
