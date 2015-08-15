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
		else if(Input::has('mode') && Input::has('mode') == "leaderboard") {

			$users = User::orderByRankDesc()
								->take(50)
								->get();

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
			 'fb_id' => Input::get('user.fb_id'),
			 'email' => Input::get('user.email'),
			 'first_name' => Input::get('user.first_name'),
			 'last_name' => Input::get('user.last_name'),
			 'img_url' => Input::get('user.img_url'),
			 'gender' => Input::get('user.gender'),
			 'score' => Input::get('user.score'),
			 'stars' => Input::get('user.stars'),
			 'reached_level' => Input::get('user.reached_level')
 		));

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
	  //
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
		$user->first_login = false;

		$user->save();

		$user = $this->prepareUser($user);

	  return '{"user":'.$user.' }';
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

			if($user->lab) {
					$user->lab_id = $user->lab->id;
			}

			if($user->rocket) {
					$user->rocket_id = $user->rocket->id;
			}
		}

		return $user;
	}

}
