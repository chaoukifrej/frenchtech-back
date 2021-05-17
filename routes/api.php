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


//!ROUTES EN GET
Route::prefix('GET')->group(function () {
    //GET CONFIRM LOGIN
    Route::get('login/{ml}/{id}', 'Auth\LoginController@confirmLogin')->name('login.confirmLogin');

    //GET LOGOUT
    Route::get('logout', 'Auth\LoginController@logout')->name('login.logout')->middleware('auth:api');

    //GET ALL ACTORS
    Route::get('actors', 'ActorController@index')->name('actor.index');

    //GET ALL BUFFERS
    Route::get('buffers', 'BufferController@index')->name('buffer.index');

    //GET ACTOR Authentifié
    Route::get('actor', 'ActorController@getConnectedActor')->name('actor.getConnectedActor')->middleware('auth:api');

    //GET MÉTRIC
    Route::get('metric', 'ActorController@show')->name('actor.show');
});

//!ROUTES EN POST
Route::prefix('POST')->group(function () {

    //LOGIN MAGIC LINK
    Route::post('login', 'Auth\LoginController@sendLoginLink')->name('login.sendLoginLink')->middleware('check');


    //REGISTER -> BUFFER
    Route::post('register', 'Auth\RegisterController@store')->name('register.store');
});

//!ROUTES ADMIN
Route::prefix('admin')->group(function () {

    //?ROUTES EN GET
    Route::prefix('GET')->group(function () {
        //GET CONFIRM LOGIN
        Route::get('login/{ml}/{id}', 'Auth\LoginController@confirmLoginAdmin')->name('login.confirmLoginAdmin');

        // DONNEE HISTORIQUE
        Route::get('historic', 'HistoricController@show')->name('historic.show');

        //GET LOGOUT
        Route::get('logout', 'Auth\LoginController@logoutAdmin')->name('login.logoutAdmin');
    });

    //?ROUTES EN POST
    Route::prefix('POST')->group(function () {
        //LOGIN -> MagicLink
        Route::post('login', 'Auth\LoginController@sendLoginLinkAdmin')->name('admin.sendLoginLinkAdmin')->middleware('check');

        //VALIDATE BUFFER --> ACTOR
        Route::post('validate', 'ActorController@store')->name('validate.store');
    });

    //?ROUTES EN POST
    Route::prefix('DELETE')->group(function () {

        // SUPPRIMER ACTOR
        Route::delete('actor', 'ActorController@destroy')->name('actor.destroy');

        // SUPPRIMER BUFFER
        Route::delete('buffer', 'BufferController@destroy')->name('buffer.destroy');
    });
});
