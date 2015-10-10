<?php

class RocketController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if(Input::has('user')) {

      $user = User::find(Input::get('user'));
      $rocket = $user->rocket;
      $rocket = $this->prepareRocket($rocket);
		  return '{ "rockets": ['.$rocket.'] }';
	  }
	  else {
			$rockets = Rocket::all();

      foreach ($rockets as $rocket)
			{
				$rocket = $this->prepareRocket($rocket);
			}

      return '{ "rockets": '.$rockets.' }';
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
		$rocket = Rocket::firstOrCreate(array(
			 'user_id' => Input::get('rocket.user_id')
		));
    $rocket = $this->prepareRocket($rocket);
	  return '{"rocket":'.$rocket.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
    $rocket = Rocket::findOrFail($id);
    $rocket = $this->prepareRocket($rocket);
		return '{"rocket":'.$rocket.' }';
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
		$rocket = Rocket::firstOrCreate(array(
			 'user_id' => Input::get('rocket.user_id')
		));

		$cannon = RocketComponent::where(array(
			'id' => Input::get('rocket.cannon_id'),
			'type' => 'cannon'
		))->first();

		$shield = RocketComponent::where(array(
			'id' => Input::get('rocket.shield_id'),
			'type' => 'shield'
		))->first();

		$engine = RocketComponent::where(array(
			'id' => Input::get('rocket.engine_id'),
			'type' => 'engine'
		))->first();

		$rocket->cannon()->associate($cannon);
		$rocket->shield()->associate($shield);
		$rocket->engine()->associate($engine);

		$rocket->save();

    $rocket = $this->prepareRocket($rocket);

	  return '{"rocket":'.$rocket.' }';
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

  private function prepareRocket($rocket)
	{
		if($rocket) {

			$cannon = RocketComponent::cannons()->where('rocket_id', $rocket->id)->first();
			$shield = RocketComponent::shields()->where('rocket_id', $rocket->id)->first();
			$engine = RocketComponent::engines()->where('rocket_id', $rocket->id)->first();

			if($cannon) {
					$rocket->cannon_id = $cannon->id;
			}

	    if($shield) {
					$rocket->shield_id = $shield->id;
			}

	    if($engine) {
					$rocket->engine_id = $engine->id;
			}
		}

		return $rocket;
	}
}
