<?php

class RocketComponentModelMmController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if(Input::has('rocketComponent') && Input::has('rocketComponentModel')) {

      $rocketComponentModelMms = RocketComponentModelMm::where(array(
        'rocketComponent_id' => Input::get('rocketComponent'),
        'rocketComponentModel_id' => Input::get('rocketComponentModel')
      ))->get();
	  }
	  else {
			$rocketComponentModelMms = RocketComponentModelMm::all();
    }

    foreach ($rocketComponentModelMms as $rocketComponentModelMm)
		{
			$rocketComponentModelMm = $this->prepareRocketComponentModelMm($rocketComponentModelMm);
		}

    return '{ "rocketComponentModelMms": '.$rocketComponentModelMms.' }';
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
    $rocketComponentModelMm = RocketComponentModelMm::firstOrCreate(array(
			 'rocketComponent_id' => Input::get('rocketComponentModelMm.rocketComponent_id'),
       'rocketComponentModel_id' => Input::get('rocketComponentModelMm.rocketComponentModel_id')
		));
    $rocketComponentModelMm = $this->prepareRocketComponentModelMm($rocketComponentModelMm);
	  return '{"rocketComponentModelMm":'.$rocketComponentModelMm.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$rocketComponentModelMm = RocketComponentModelMm::findOrFail($id);
    $rocketComponentModelMm = $this->prepareRocketComponentModelMm($rocketComponentModelMm);
		return '{"rocketComponentModelMm":'.$rocketComponentModelMm.' }';
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
		$rocketComponentModelMm = RocketComponentModelMm::findOrFail($id);
		$rocketComponentModelMm->construction_start = Input::get('rocketComponentModelMm.construction_start');
		$rocketComponentModelMm->status = Input::get('rocketComponentModelMm.status');
		$rocketComponentModelMm->rocketComponent_id = Input::get('rocketComponentModelMm.rocketComponent_id');
		$rocketComponentModelMm->rocketComponentModel_id = Input::get('rocketComponentModelMm.rocketComponentModel_id');

		if(Input::get('rocketComponentModelMm.rocketComponentModelCapacityLevelMm_id') != null) {
			$rocketComponentModelMm->rocketComponentModelCapacityLevelMm_id = Input::get('rocketComponentModelMm.rocketComponentModelCapacityLevelMm_id');
		}

		if(Input::get('rocketComponentModelMm.rocketComponentModelRechargeRateLevelMm_id') != null) {
			$rocketComponentModelMm->rocketComponentModelRechargeRateLevelMm_id = Input::get('rocketComponentModelMm.rocketComponentModelRechargeRateLevelMm_id');
		}

		$rocketComponentModelMm->save();

    $rocketComponentModelMm = $this->prepareRocketComponentModelMm($rocketComponentModelMm);
	  return '{"rocketComponentModelMm":'.$rocketComponentModelMm.' }';
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

  private function prepareRocketComponentModelMm($rocketComponentModelMm)
	{
		return $rocketComponentModelMm;
	}
}
