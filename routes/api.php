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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('me', function (Request $request) {
    return Auth::user()??['errror'=>'not authenticated'];
});

Route::group(['prefix'=>'my'],function (){
    Route::resource('reviews','FeedbackController');
});

Route::group(['prefix'=>'v2'],function (){

    Route::get('{obj}/{id}/votes', 'VoteController@index');
    Route::get('{obj}/{id}/vote', 'VoteController@show');
    Route::post('{obj}/{id}/vote', 'VoteController@store')->middleware('auth');  // TODO: policy

});