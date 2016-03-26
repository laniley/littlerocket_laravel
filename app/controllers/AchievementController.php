<?php

class AchievementController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$achievements = Achievement::all();
    // foreach ($achievements as $achievement) {
    //   $achievement = $this->prepare($achievement);
    // }
    return '{ "achievements": '.$achievements.' }';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// $rocket = Rocket::firstOrCreate(array(
		// 	 'user_id' => Input::get('rocket.user_id')
		// ));
    // $rocket = $this->prepareRocket($rocket);
	  // return '{"rocket":'.$rocket.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// $achievement = Achievement::findOrFail($id);
    // $achievement = $this->prepare($achievement);
    // return '{ "achievement": '.$achievement.' }';
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$achievement_mm = UserAchievementMm::findOrFail($id);
		$achievement_mm->unlocked = Input::get('achievement.unlocked');
		$achievement_mm->save();
		// $achievement = $this->prepare($achievement_mm);
		return '{"achievement":'.$achievement_mm.' }';
	}

  private function prepare($achievement) {
		if($achievement) {
			$achievement->me_id = 1;
		}

		return $achievement;
	}
}
