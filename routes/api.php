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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', 'UserController@register');
Route::group([
		'prefix' => 'user'
	],
	function() {
		Route::get('', 'UserController@index');
		Route::get('search', 'UserController@search');
		Route::get('{user_id}', 'UserController@show');
		Route::post('{user_id}/edit', 'UserController@update');
	}
);