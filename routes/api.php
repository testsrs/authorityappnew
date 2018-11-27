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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');





Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');
	Route::post('userlist', 'API\UserController@userList');
	Route::post('uploadImage', 'API\UserController@userImageUpload');
});


# Group API routes <--START
Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'group'
], function () {    
    Route::post('createGroup', 'GroupController@createGroup');
    Route::post('updateGroup', 'GroupController@updateGroup');
    Route::post('deleteGroup', 'GroupController@deleteGroup');
    Route::post('getPendingJoinRequest', 'GroupController@getPendingJoinRequest');
    
});
# Group API routes END-->

Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});
