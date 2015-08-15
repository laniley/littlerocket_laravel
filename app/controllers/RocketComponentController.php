<?php

class RocketComponentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if(Input::has('rocket') && Input::has('type')) {

      $rocketComponents = RocketComponent::find(array(
        'rocket_id' => Input::get('rocket'),
        'type' => Input::get('type')
      ));
	  }
	  else {
			$rocketComponents = RocketComponent::all();
    }

    foreach ($rocketComponents as $rocketComponent)
		{
			$rocketComponent = $this->prepareRocketComponent($rocketComponent);
		}

    return '{ "rocketComponents": '.$rocketComponents.' }';
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
		$rocketComponent = RocketComponent::firstOrCreate(array(
			 'rocket_id' => Input::get('rocketComponent.rocket_id'),
       'type' => Input::get('rocketComponent.type')
		));

    $rocketComponent->type = Input::get('rocketComponent.type');
    $rocketComponent->costs = Input::get('rocketComponent.costs');
    $rocketComponent->construction_time = Input::get('rocketComponent.construction_time');
    $rocketComponent->construction_start = Input::get('rocketComponent.construction_start');
    $rocketComponent->status = Input::get('rocketComponent.status');

    $rocketComponent->save();

    $rocketComponent = $this->prepareRocketComponent($rocketComponent);

	  return '{"rocketComponent":'.$rocketComponent.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$rocketComponent = RocketComponent::findOrFail($id);
    $rocketComponent = $this->prepareRocketComponent($rocketComponent);
		return '{"rocketComponent":'.$rocketComponent.' }';
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

  private function prepareRocketComponent($rocketComponent)
	{
		// if($rocket->canon) {
		// 		$rocket->canon_id = $rocket->canon->id;
		// }
    //
    // if($rocket->shield) {
		// 		$rocket->shield_id = $rocket->shield->id;
		// }
    //
    // if($rocket->engine) {
		// 		$rocket->engine_id = $rocket->engine->id;
		// }

		return $rocketComponent;
	}
}
