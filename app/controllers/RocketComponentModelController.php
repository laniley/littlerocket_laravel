<?php

class RocketComponentModelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if(Input::has('model') || Input::has('type')) {

			if(Input::has('model') && Input::has('type')) {
	      $rocketComponentModels = RocketComponentModel::where(array(
	        'model' => Input::get('model'),
	        'type' => Input::get('type')
	      ))->get();
			}
			else if(Input::has('type')) {
				$rocketComponentModels = RocketComponentModel::where(array(
	        'type' => Input::get('type')
	      ))->get();
			}
	  }
	  else {
			$rocketComponentModels = RocketComponentModel::all();
    }

    foreach ($rocketComponentModels as $rocketComponentModel)
		{
			$rocketComponentModel = $this->prepareRocketComponentModel($rocketComponentModel);
		}

    return '{ "rocketComponentModels": '.$rocketComponentModels.' }';
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
		$rocketComponentModel = RocketComponentModel::findOrFail($id);
    $rocketComponentModel = $this->prepareRocketComponentModel($rocketComponentModel);
		return '{"rocketComponentModel":'.$rocketComponentModel.' }';
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

  private function prepareRocketComponentModel($rocketComponentModel)
	{
		return $rocketComponentModel;
	}
}
