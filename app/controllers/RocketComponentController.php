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

      $rocketComponents = RocketComponent::where(array(
        'rocket_id' => Input::get('rocket'),
        'type' => Input::get('type')
      ))->get();
	  }
	  else {
			$rocketComponents = RocketComponent::all();
    }

    foreach ($rocketComponents as $rocketComponent) {
			$rocketComponent = $this->prepareRocketComponent($rocketComponent);
		}

    return '{ "rocketComponents": '.$rocketComponents.' }';
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$rocketComponent = RocketComponent::firstOrCreate(array(
			 'rocket_id' => Input::get('rocketComponent.rocket_id'),
       'type' => Input::get('rocketComponent.type')
		));

		$rocketComponent->type = Input::get('rocketComponent.type');
    $rocketComponent->costs = Input::get('rocketComponent.costs');
    $rocketComponent->construction_time = Input::get('rocketComponent.construction_time');
    $rocketComponent->construction_start = Input::get('rocketComponent.construction_start');
    $rocketComponent->status = Input::get('rocketComponent.status');

		if(Input::has('rocketComponent.selectedRocketComponentModelMm_id')) {
			$selectedRocketComponentModelMm = RocketComponentModelMm::find(Input::get('rocketComponent.selectedRocketComponentModelMm_id'));

			if($selectedRocketComponentModelMm) {
				$rocketComponent->selectedRocketComponentModelMm_id = $selectedRocketComponentModelMm->id;
			}
		}

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
		$rocketComponentModelMms = $rocketComponent->myRocketComponentModelMms;
		return '{"rocketComponent":'.$rocketComponent.', "rocketComponentModelMms": '.$rocketComponentModelMms.'}';
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rocketComponent = RocketComponent::findOrFail($id);

    $rocketComponent->construction_start = Input::get('rocketComponent.construction_start');
    $rocketComponent->status = Input::get('rocketComponent.status');

		if(Input::has('rocketComponent.selectedRocketComponentModelMm_id')) {
			$selectedRocketComponentModelMm = RocketComponentModelMm::find(Input::get('rocketComponent.selectedRocketComponentModelMm_id'));

			if($selectedRocketComponentModelMm) {
				$rocketComponent->selectedRocketComponentModelMm_id = $selectedRocketComponentModelMm->id;
			}
		}

    $rocketComponent->save();

    $rocketComponent = $this->prepareRocketComponent($rocketComponent);

	  return '{"rocketComponent":'.$rocketComponent.' }';
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
		$modelMms = $rocketComponent->myRocketComponentModelMms;
		$modelMmIds = [];
		foreach($modelMms as $modelMm) {
			array_push($modelMmIds, $modelMm->id);
		}
		$rocketComponent["rocketComponentModelMms"] = $modelMmIds;
		return $rocketComponent;
	}
}
