<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => '/api/v1/'), function()
{

    Route::resource('users', 'UserController');
    Route::resource('labs', 'LabController');
    Route::resource('rockets', 'RocketController');
    Route::resource('rocketComponents', 'RocketComponentController');
    Route::resource('rocketComponentModels', 'RocketComponentModelController');
    Route::resource('rocketComponentModelMms', 'RocketComponentModelMmController');
    Route::resource('rocketComponentModelLevels', 'RocketComponentModelLevelController');

});
