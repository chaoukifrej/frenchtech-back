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
    //GET ALL ACTORS
    Route::get('actors', 'ActorController@index')->name('actor.index');

    //GET MÉTRIC
    Route::get('metric', 'ActorController@show')->name('actor.show');
});

//!ROUTES EN POST
Route::prefix('POST')->group(function () {
    //REGISTER -> BUFFER
    Route::post('register', 'auth\RegisterController@store')->name('register.store');

    //LOGIN MAGIC LINK
    Route::post('login', 'auth\LoginController@sendLoginLink')->name('login.sendLoginLink');
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
