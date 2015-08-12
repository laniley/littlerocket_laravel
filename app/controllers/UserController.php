<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// test the DB-Connection
		try
	  {
	      $pdo = DB::connection('mysql')->getPdo();
	  }
	  catch(PDOException $exception)
	  {
	      return Response::make('Database error! ' . $exception->getCode() . ' - ' . $exception->getMessage());
	  }

	  if(Input::has('fb_id'))
	  {
	   	$fb_id = Input::get('fb_id');

			$user = User::where('fb_id', '=', $fb_id)->first();

		  return '{ "users": ['.$user.'] }';
	  }
	  else
	   	$users = User::all();
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
		$fb_id = Input::get('user.fb_id');
		$email = Input::get('user.email');
		$first_name = Input::get('user.first_name');
		$last_name = Input::get('user.last_name');
		$img_url = Input::get('user.img_url');
		$gender = Input::get('user.gender');
		$score = Input::get('user.score');
		$stars = Input::get('user.stars');
		$reached_level = Input::get('user.reached_level');
		$lab_id = Input::get('user.lab');
		$lab_rocket = Input::get('user.rocket');
		// $first_login = Input::get('user.first_login');
		// $last_login = Input::get('user.last_login');

		// if($last_login == null)
		// {
		// 	$last_login = '0000-00-00 00:00:00';
		// }

		// test the DB-Connection
		try
	  {
	      $pdo = DB::connection('mysql')->getPdo();
	  }
	  catch(PDOException $exception)
	  {
	      return Response::make('Database error! ' . $exception->getCode() . ' - ' . $exception->getMessage());
	  }

	  // check if user already exists
	  $user = DB::table('users')
	   			->where('fb_id', $fb_id)
	   			->whereNotNull('fb_id')
	   			->first();

	   // save login
	   if(!$user) // insert user
	   {
				$id = DB::table('users')
					->insertGetId(
				    	array(
				    			'fb_id' => $fb_id,
				    			'email' => $email,
				    			'first_name' => $first_name,
				    			'last_name' => $last_name,
				    			'gender' => $gender,
				    			'img_url' => $img_url
				    		)
						);
		 }

		 $user = User::findOrFail($id);

	   return '{"user":'.$user.' }';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	  //  $user = User::findOrFail($id);
		//
	  //  // MEETHUB-COMMENTS
	  //  $meethubs = [];
		// $comments = [];
		//
	  //  $meethubMemberships_of_user = DB::table('mm_users_meethubs')
		// ->where('user_id', '=', $id)
    //   ->get();
		//
	  //  foreach ($meethubMemberships_of_user as $membership_object)
		// {
		// 	$membership = (array)$membership_object;
		//
		// 	if(!in_array($membership["meethub_id"], $meethubs))
		// 		array_push($meethubs, $membership["meethub_id"]);
		// }
		//
		// // meethubComments
		// 	foreach ($meethubs as $meethub)
		// 	{
		//       $comments_of_meethub = MeethubComment::where('meethub_id', '=', $meethub)->get();
		//
		// 		foreach ($comments_of_meethub as $comment_of_meethub)
		// 		{
		// 			array_push($comments, $comment_of_meethub->id);
		// 		}
		// 	}
		//
		// 	$user["meethubComments"] = $comments;
		//
		// // eventInvitations
		// 	$invites = EventInvitation::where('user_id', '=', $id)->get();
		//
		// 	$invite_ids = [];
		//
		// 	$currentUser = DB::table('users')
	  //  			->where('fb_id', Request::header('userid'))
	  //  			->whereNotNull('fb_id')
	  //  			->first();
		//
		// 	foreach ($invites as $invite)
		// 	{
		// 		if($user->id == $currentUser->id)
		//    	{
		//    		$invite["belongsToMe"] = true;
		//    	}
		//
		// 	   if(!in_array($invite["id"], $invite_ids))
		// 			array_push($invite_ids, $invite["id"]);
		// 	}
		//
		// 	$user["eventInvitations"] = $invite_ids;
		//
		// // isMe
		// 	if(Request::header('userid') == $user->fb_id)
		// 	{
		// 		$user["isMe"] = true;
		// 	}
		//
	  //  return '{ "user":'.$user.' }';
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
		// $fb_id = Input::get('user.fb_id');
		// $email = Input::get('user.email');
		// $first_name = Input::get('user.first_name');
		// $last_name = Input::get('user.last_name');
		// $picture = Input::get('user.picture');
		// $gender = Input::get('user.gender');
		// $friends = Input::get('user.friends');
		// $first_login = Input::get('user.first_login');
		// $last_login = Input::get('user.last_login');
		//
		// // test the DB-Connection
		// try
	  //  {
	  //     $pdo = DB::connection('mysql')->getPdo();
	  //  }
	  //  catch(PDOException $exception)
	  //  {
	  //     return Response::make('Database error! ' . $exception->getCode() . ' - ' . $exception->getMessage());
	  //  }
		//
	  //  DB::table('users')
    //         ->where('id', $id)
    //         ->update(
    //         	array(
		// 	    			'fb_id' => $fb_id,
		// 	    			'email' => $email,
		// 	    			'first_name' => $first_name,
		// 	    			'last_name' => $last_name,
		// 	    			'gender' => $gender,
		// 	    			'picture' => $picture,
		// 	    			'first_login' => $first_login,
		// 	    			'last_login' => $last_login
    //         		)
    //         	);
		//
	  //  $user = User::findOrFail($id);


	   // MEETHUB-COMMENTS
	  //  $meethubs = [];
		// $comments = [];
		//
	  //  $meethubMemberships_of_user = DB::table('mm_users_meethubs')
		// ->where('user_id', '=', $user->id)
    //   ->get();
		//
	  //  foreach ($meethubMemberships_of_user as $membership_object)
		// {
		// 	$membership = (array)$membership_object;
		//
		// 	if(!in_array($membership["meethub_id"], $meethubs))
		// 		array_push($meethubs, $membership["meethub_id"]);
		// }
		//
		// foreach ($meethubs as $meethub)
		// {
	  //     $comments_of_meethub = MeethubComment::where('meethub_id', '=', $meethub)->get();
		//
		// 	foreach ($comments_of_meethub as $comment_of_meethub)
		// 	{
		// 		array_push($comments, $comment_of_meethub->id);
		// 	}
		// }
		//
		// $user["meethubComments"] = $comments;
		//
	  //  return '{"user":'.$user.' }';
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
