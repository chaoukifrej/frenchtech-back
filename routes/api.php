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

//route::get('/test', 'HomeController@test');

//REGISTER
Route::post('POST/register', 'auth\RegisterController@store')->name('register.store');


//GET ALL ACTORS
Route::get('GET/actors', 'ActorController@index')->name('actor.index');


//GET MÉTRIC
Route::get('GET/metric', 'ActorController@show')->name('actor.show');
