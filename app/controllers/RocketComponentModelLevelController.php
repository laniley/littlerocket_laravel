<?php

class RocketComponentModelLevelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('type') || Input::has('level') || Input::has('rocketComponentModel')) {
		  if(Input::has('type') && Input::has('level') && Input::has('rocketComponentModel')) {
	      $rocketComponentModelLevels = RocketComponentModelLevel::where(array(
	        'type' => Input::get('type'),
	        'level' => Input::get('level'),
	        'rocketComponentModel_id' => Input::get('rocketComponentModel')
	      ))->get();
		  }
			else if(Input::has('type') && Input::has('rocketComponentModel')) {
				$rocketComponentModelLevels = RocketComponentModelLevel::where(array(
	        'type' => Input::get('type'),
	        'rocketComponentModel_id' => Input::get('rocketComponentModel')
	      ))->get();
			}
		}
	  else {
			$rocketComponentModelLevels = RocketComponentModelLevel::all();
    }

    foreach ($rocketComponentModelLevels as $rocketComponentModelLevel)
		{
			$rocketComponentModelLevel = $this->prepareRocketComponentModelLevel($rocketComponentModelLevel);
		}

    return '{ "rocketComponentModelLevels": '.$rocketComponentModelLevels.' }';
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
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$rocketComponentModelLevel = RocketComponentModelLevel::findOrFail($id);
    $rocketComponentModelLevel = $this->prepareRocketComponentModelLevel($rocketComponentModelLevel);
		return '{"rocketComponentModelLevel":'.$rocketComponentModelLevel.' }';
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
		//
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

  private function prepareRocketComponentModelLevel($rocketComponentModelLevel)
	{
		if($rocketComponentModelLevel->type == 'recharge_rate') {
			$rocketComponentModelLevel->value = $rocketComponentModelLevel->value / 10;
		}
		return $rocketComponentModelLevel;
	}
}
