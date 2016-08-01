<?php

class UserQuestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$quests = new Quest();

		if(Input::has('user_id')) {
			$quests = $quests	->leftJoin('users_quests', function ($join) {
														$join->on('users_quests.quest_id', '=', 'quests.parent_id')
																 ->where('user_id', '=', Input::get('user_id'));
													})
													->whereNull('quests.parent_id')
													->orWhereNotNull('users_quests.id')
													->select(DB::raw("concat('".Input::get('user_id')."_' , quests.id) as id"), DB::raw("'".Input::get('user_id')."' as user_id"), 'quest_id');
		}

		$quests = $quests->get();

		return '{ "userQuests": '.$quests.' }';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// $message = new Message();
		// $message->type = Input::get('message.type');
		// $message->from_user_id = Input::get('message.from_user_id');
		// $message->to_user_id = Input::get('message.to_user_id');
		// $message->save();
	  // return '{"message":'.$message.' }';
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
		// Message::destroy($id);
		// return '{}';
	}
}
