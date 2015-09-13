<?php

class RocketComponentModelLevelMmController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if(Input::has('rocketComponentModelMm') && Input::has('rocketComponentModelLevel')) {

      $rocketComponentModelLevelMms = RocketComponentModelLevelMm::where(array(
        'rocketComponentModelMm_id' => Input::get('rocketComponentModelMm'),
        'rocketComponentModelLevel_id' => Input::get('rocketComponentModelLevel')
      ))->get();
	  }
	  else {
			$rocketComponentModelLevelMms = RocketComponentModelLevelMm::all();
    }

    foreach ($rocketComponentModelLevelMms as $rocketComponentModelLevelMm)
		{
			$rocketComponentModelLevelMm = $this->prepareRocketComponentModelLevelMm($rocketComponentModelLevelMm);
		}

    return '{ "rocketComponentModelLevelMms": '.$rocketComponentModelLevelMms.' }';
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
    $rocketComponentModelLevelMm = RocketComponentModelLevelMm::firstOrCreate(array(
      'rocketComponentModelMm_id' => Input::get('rocketComponentModelLevelMm.rocketComponentModelMm_id'),
      'rocketComponentModelLevel_id' => Input::get('rocketComponentModelLevelMm.rocketComponentModelLevel_id')
		));
		$rocketComponentModelLevelMm->status = Input::get('rocketComponentModelLevelMm.status');
		$rocketComponentModelLevelMm->save();
    $rocketComponentModelLevelMm = $this->prepareRocketComponentModelLevelMm($rocketComponentModelLevelMm);
	  return '{"rocketComponentModelLevelMm":'.$rocketComponentModelLevelMm.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$rocketComponentModelLevelMm = RocketComponentModelLevelMm::findOrFail($id);
    $rocketComponentModelLevelMm = $this->prepareRocketComponentModelLevelMm($rocketComponentModelLevelMm);
		return '{"rocketComponentModelLevelMm":'.$rocketComponentModelLevelMm.' }';
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
		$rocketComponentModelLevelMm = RocketComponentModelLevelMm::findOrFail($id);
		$rocketComponentModelLevelMm->status = Input::get('rocketComponentModelLevelMm.status');
		$rocketComponentModelLevelMm->save();
    $rocketComponentModelLevelMm = $this->prepareRocketComponentModelLevelMm($rocketComponentModelLevelMm);
		return '{"rocketComponentModelLevelMm":'.$rocketComponentModelLevelMm.' }';
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

  private function prepareRocketComponentModelLevelMm($rocketComponentModelLevelMm)
	{
		return $rocketComponentModelLevelMm;
	}
}
