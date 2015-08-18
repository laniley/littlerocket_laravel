<?php

class LabController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('user')) {

      $user = User::find(Input::get('user'));

		  return '{ "labs": ['.$user->lab.'] }';
	  }
	  else {
			$labs = Lab::all();
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
		$lab = Lab::firstOrCreate(array(
			 'user_id' => Input::get('lab.user_id'),
			 'costs' => Input::get('lab.costs'),
			 'construction_time' => Input::get('lab.construction_time'),
			 'construction_start' => Input::get('lab.construction_start'),
			 'status' => Input::get('lab.status')
		));

	  return '{"lab":'.$lab.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$lab = Lab::findOrFail($id);

		return '{"lab":'.$lab.' }';
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
		$lab = Lab::findOrFail($id);

    $lab->construction_start = Input::get('lab.construction_start');
		$lab->status = Input::get('lab.status');

		$lab->save();

	  return '{"lab":'.$lab.' }';
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


}
