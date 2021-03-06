<?php

class MessageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$messages = new Message();

		if(Input::has('to_user_id')) {
			$messages = $messages->where('to_user_id', Input::get('to_user_id'));
		}
		//
		// if(Input::has('type')) {
		// 	$requests = $requests->where('type', Input::get('type'));
		// }
		//
		// if(Input::has('fb_id')) {
		// 	$requests = $requests->where('fb_id', Input::get('fb_id'));
		// 	// try to find to_user_id
		// 	$to_user = User::first(array('fb_id', Input::get('fb_id')));
		// }

		$messages = $messages->get();

		// if(isset($to_user)) {
		// 	foreach($requests as $request) {
		// 		$request["to_user_id"] = $to_user->id;
		// 	}
		// }

		return '{ "messages": '.$messages.' }';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$message = new Message();
		$message->type = Input::get('message.type');
		$message->from_user_id = Input::get('message.from_user_id');
		$message->to_user_id = Input::get('message.to_user_id');
		$message->save();
	  return '{"message":'.$message.' }';
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
		Message::destroy($id);
		return '{}';
	}
}
