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

//List tasks
Route::get('tasks','TaskController@index');

//List single task
Route::get('task/{id}','TaskController@show');

//Create new task
Route::post('task','TaskController@store');

//Update task
Route::put('task','TaskController@store');

//Delete task
Route::delete('task/{id}','TaskController@destroy');
