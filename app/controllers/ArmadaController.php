<?php

class ArmadaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$mode = Input::get('mode');
		if(isset($mode) && $mode == "searchByName") {
			$name = Input::get('name');
			$armadas = Armada::where('name', $name)->get();
			return '{ "armadas": '.$armadas.' }';
		}
		else if(isset($mode) && $mode == "suggestions") {
			$armadas = Armada::orderByMembersCountDesc()->get();
			$userIds = [];
			$allUsers = [];
			foreach($armadas as $armada) {
				$users = User::ofArmada($armada)->get();
				foreach($users as $user) {
					array_push($userIds, $user->id);
					array_push($allUsers, $user);
				}
			}

			return '{ "armadas": '.$armadas.', "users": ['.implode($allUsers, ',').'] }';
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$armada = Armada::firstOrCreate(array(
			 'name' => Input::get('armada.name')
		));
	  return '{"armada":'.$armada.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$armada = Armada::findOrFail($id);

		$users = User::ofArmada($armada)->get();
		$userIds = [];
		foreach($users as $user) {
			array_push($userIds, $user->id);
		}
		$armada["users"] = $userIds;

		$requests = ArmadaMembershipRequest::where('armada_id', $id)->get();
		$requestIds = [];
		foreach($requests as $request) {
			array_push($requestIds, $request->id);
		}
		$armada['armadaMembershipRequests'] = $requestIds;

    return '{ "armada": '.$armada.', "users": '.$users.', "armadaMembershipRequests": '.$requests.' }';
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
