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

    //DEMANDE DE SUPPRESSION
    Route::get('delete/demand/{id}', 'ActorController@sendDelete')->name('actor.sendDelete');

    //DEMANDE DE MODIFICATION
    Route::get('update/demand/{id}', 'ActorController@sendUpdate')->name('actor.sendUpdate');
});

//!ROUTES EN POST
Route::prefix('POST')->group(function () {

    //LOGIN MAGIC LINK
    Route::post('login', 'Auth\LoginController@sendMagicLink')->name('login.sendMagicLink');

    //REGISTER -> BUFFER
    Route::post('register', 'Auth\RegisterController@store')->name('register.store');
});

//!ROUTES ADMIN
Route::prefix('admin')->group(function () {
    //?ROUTES EN GET
    Route::prefix('GET')->group(function () {

        // GET ALL ADMINS
        Route::get('admins', 'AdminController@index')->name('admin.index');

        //GET CONFIRM LOGIN
        Route::get('login/{ml}/{id}', 'Auth\LoginController@confirmLoginAdmin')->name('login.confirmLoginAdmin');

        // DONNEE HISTORIQUE
        Route::get('historic', 'HistoricController@show')->name('historic.show');

        //GET LOGOUT
        Route::get('logout', 'Auth\LoginController@logoutAdmin')->name('login.logoutAdmin');

        //GET ALL ACTORS WITH ALL INFOS
        Route::get('actors', 'ActorController@getAllInfosActors')->name('actor.getAllInfosActors')->middleware('auth:admin');
    });

    //?ROUTES EN POST
    Route::prefix('POST')->group(function () {
        //VALIDATE BUFFER --> ACTOR
        Route::post('validate/{id}', 'ActorController@store')->name('validate.store');

        // CREATION ADMIN
        Route::post('create', 'AdminController@store')->name('create.store');
    });

    //?ROUTES EN PUT
    Route::prefix('PUT')->group(function () {

        //MODIFIER BUFFER
        Route::put('buffer/{id}', 'BufferController@update')->name('buffer.update');

        //MODIFIER ACTORS
        Route::put('actor/{id}', 'ActorController@update')->name('actor.update');

        //MODIFIER ADMIN
        Route::put('admin/{id}', 'AdminController@update')->name('admin.update');

        // MODIFICATION ACTOR SUITE A DEMANDE
        Route::put('update/actor/{id}', 'ActorController@updateDemande')->name('actor.updateDemande');
    });

    //?ROUTES EN DELETE
    Route::prefix('DELETE')->group(function () {

        // SUPPRIME DIRECT -> ACTOR
        Route::delete('actor/{id}', 'ActorController@destroy')->name('actor.destroy')->middleware('auth:admin');

        // SUPPRIME DIRECT -> BUFFER
        Route::delete('buffer/{id}', 'BufferController@destroy')->name('buffer.destroy');

        // SUPPRIME DIRECT -> ADMIN
        Route::delete('admin/{id}', 'AdminController@destroy')->name('admin.destroy');

        // SUPPRIMER ACTOR/BUFFER SUITE A DEMANDE "DELETE"
        Route::delete('delete/actor/{id}', 'ActorController@deleteDemande')->name('actor.deleteDemande');
    });
});


//!ROUTES EXCEL
Route::prefix('excel')->group(function () {
    Route::get('actors/export', 'ActorsExportController@export');
    Route::get('actors/exportPublic', 'ActorsExportController@exportPublic');
    Route::get('actors/exportPrivate', 'ActorsExportController@exportPrivate');
    Route::get('buffers/exportRegister', 'BuffersExportController@exportRegister');
    Route::get('buffers/exportModify', 'BuffersExportController@exportModify');
    Route::get('buffers/exportDelete', 'BuffersExportController@exportDelete');
});


//!Routes verif si connecté
Route::get('checkActor', 'Auth\VerificationController@checkActor')->middleware("auth:api");
Route::get('checkAdmin', 'Auth\VerificationController@checkAdmin')->middleware("auth:admin");
