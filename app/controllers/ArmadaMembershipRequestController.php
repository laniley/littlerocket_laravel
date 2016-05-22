<?php

class ArmadaMembershipRequestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$requests = new ArmadaMembershipRequest();

		if(Input::has('armada_id')) {
			$requests = $requests->where('armada_id', Input::get('armada_id'));
		}

		if(Input::has('user_id')) {
			$requests = $requests->where('user_id', Input::get('user_id'));
		}

		$requests = $requests->get();

		return '{ "armadaMembershipRequests": '.$requests.' }';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$request = ArmadaMembershipRequest::firstOrCreate(array(
			 'user_id' => Input::get('armadaMembershipRequest.user_id'),
       'armada_id' => Input::get('armadaMembershipRequest.armada_id')
		));
	  return '{"armadaMembershipRequest":'.$request.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// $armada = Armada::findOrFail($id);
		// $users = User::ofArmada($armada)->get();
		// $userIds = [];
		// foreach($users as $user) {
		// 	array_push($userIds, $user->id);
		// }
		// $armada["users"] = $userIds;
    // return '{ "armada": '.$armada.', "users": '.$users.' }';
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// $achievement_mm = UserAchievementMm::findOrFail($id);
		// $achievement_mm->unlocked = Input::get('achievement.unlocked');
		// $achievement_mm->save();
		// // $achievement = $this->prepare($achievement_mm);
		// return '{"achievement":'.$achievement_mm.' }';
	}
}
