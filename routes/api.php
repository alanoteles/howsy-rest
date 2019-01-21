<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['api','cors']], function () {
    Route::post('auth/register', 	'Auth\ApiRegisterController@create');

    Route::get('addresses', 		'PropertyController@index');
	Route::get('address/{id}', 		'PropertyController@show');
	Route::post('address', 			'PropertyController@store');
    Route::put('address', 			'PropertyController@store');
    Route::delete('address/{id}', 	'PropertyController@destroy');

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



