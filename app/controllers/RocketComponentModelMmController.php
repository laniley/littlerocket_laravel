<?php

class RocketComponentModelMmController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('rocketComponent') || Input::has('rocketComponentModel')) {
		  if(Input::has('rocketComponent') && Input::has('rocketComponentModel')) {
	      $rocketComponentModelMms = RocketComponentModelMm::where(array(
	        'rocketComponent_id' => Input::get('rocketComponent'),
	        'rocketComponentModel_id' => Input::get('rocketComponentModel')
	      ))->get();
		  }
			else if(Input::has('rocketComponent')) {
				$rocketComponentModelMms = RocketComponentModelMm::where(array(
	        'rocketComponent_id' => Input::get('rocketComponent')
	      ))->get();
			}
		}
	  else {
			$rocketComponentModelMms = RocketComponentModelMm::all();
    }

		$rocketComponentModelLevelMms = [];

    foreach ($rocketComponentModelMms as $rocketComponentModelMm)
		{
			$rocketComponentModelMm = $this->prepareRocketComponentModelMm($rocketComponentModelMm);
			$levelMms = $rocketComponentModelMm->myRocketComponentModelLevelMms;
			foreach($levelMms as $levelMm) {
				array_push($rocketComponentModelLevelMms, $levelMm);
			}
		}

    return '{ "rocketComponentModelMms": '.$rocketComponentModelMms.', "rocketComponentModelLevelMms": ['.implode($rocketComponentModelLevelMms, ',').']}';
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
		$rocketComponentModelMm->status = Input::get('rocketComponentModelMm.status');
		$rocketComponentModelMm->save();
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
		$rocketComponentModelLevelMms = $rocketComponentModelMm->myRocketComponentModelLevelMms;
		return '{"rocketComponentModelMm":'.$rocketComponentModelMm.', "rocketComponentModelLevelMms": '.$rocketComponentModelLevelMms.'}';
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

		if(Input::get('rocketComponentModelMm.selectedRocketComponentModelCapacityLevelMm_id') != null) {
			$rocketComponentModelMm->rocketComponentModelCapacityLevelMm_id = Input::get('rocketComponentModelMm.selectedRocketComponentModelCapacityLevelMm_id');
		}

		if(Input::get('rocketComponentModelMm.selectedRocketComponentModelRechargeRateLevelMm_id') != null) {
			$rocketComponentModelMm->rocketComponentModelRechargeRateLevelMm_id = Input::get('rocketComponentModelMm.selectedRocketComponentModelRechargeRateLevelMm_id');
		}

		$rocketComponentModelMm->save();

    $rocketComponentModelMm = $this->prepareRocketComponentModelMm($rocketComponentModelMm);
		$rocketComponentModelLevelMms = $rocketComponentModelMm->myRocketComponentModelLevelMms;
		return '{"rocketComponentModelMm":'.$rocketComponentModelMm.', "rocketComponentModelLevelMms": '.$rocketComponentModelLevelMms.'}';
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
		$rocketComponentModelMm["selectedRocketComponentModelCapacityLevelMm_id"] = $rocketComponentModelMm["rocketComponentModelCapacityLevelMm_id"];
		$rocketComponentModelMm["selectedRocketComponentModelRechargeRateLevelMm_id"] = $rocketComponentModelMm["rocketComponentModelRechargeRateLevelMm_id"];

		$rocketComponentModelLevelMms = $rocketComponentModelMm->myRocketComponentModelLevelMms;
		$modelMmIds = [];
		foreach($rocketComponentModelLevelMms as $modelMm) {
			array_push($modelMmIds, $modelMm->id);
		}
		$rocketComponentModelMm["rocketComponentModelLevelMms"] = $modelMmIds;

		return $rocketComponentModelMm;
	}
}
