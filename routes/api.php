<?php


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



//!ROUTES EN GET
Route::prefix('GET')->group(function () {
    //GET CONFIRM LOGIN
    Route::get('login/{ml}/{id}', 'Auth\LoginController@confirmLogin')->name('login.confirmLogin');

    //GET ALL ACTORS
    Route::get('actors', 'ActorController@index')->name('actor.index');

    //GET ACTOR Auth
    Route::get('actor', 'ActorController@getConnectedActor')->name('actor.getConnectedActor')->middleware('auth:api');

    //GET MÉTRIC
    Route::get('metric', 'ActorController@show')->name('actor.show');
});

//!ROUTES EN POST
Route::prefix('POST')->group(function () {
    //LOGIN MAGIC LINK
    Route::post('login', 'Auth\LoginController@sendLoginLink')->name('login.sendLoginLink');

    //REGISTER -> BUFFER
    Route::post('register', 'Auth\RegisterController@store')->name('register.store');
});

//!ROUTES ADMIN
Route::prefix('admin')->group(function () {
    //?ROUTES EN GET
    Route::prefix('GET')->group(function () {
    });

    //?ROUTES EN POST
    Route::prefix('POST')->group(function () {
    });
});
