<?php

class FBAppRequestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$requests = new FBAppRequest();

		if(Input::has('armada_id')) {
			$requests = $requests->where('armada_id', Input::get('armada_id'));
		}

		if(Input::has('type')) {
			$requests = $requests->where('type', Input::get('type'));
		}

		if(Input::has('fb_id')) {
			$requests = $requests->where('fb_id', Input::get('fb_id'));
		}

		$requests = $requests->get();

		if(Input::has('fb_id')) {
			$users = User::where('fb_id', Input::get('fb_id'))->first();
			foreach($requests as $request) {
				$request['user_id'] = $users['id'];
			}
		}

		return '{ "fbAppRequests": '.$requests.' }';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$request = FBAppRequest::firstOrCreate(array(
			 'fb_request_id' => Input::get('fbAppRequest.fb_request_id'),
			 'fb_id' => Input::get('fbAppRequest.fb_id'),
		));
		$request->type = Input::get('fbAppRequest.type');
		$request->fb_id = Input::get('fbAppRequest.fb_id');
		$request->armada_id = Input::get('fbAppRequest.armada_id');
		$request->save();
	  return '{"fbAppRequest":'.$request.' }';
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

	public function destroy($id) {
		FBAppRequest::destroy($id);
		return '{}';
	}
}
