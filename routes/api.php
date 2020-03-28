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

Route::middleware('auth:api')->group(function () {

//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });


    Route::middleware('isAdmin')->group(function () {
        Route::post('/users', 'UserController@getUsers');
    });

    Route::middleware('isAdminOrSelf')->group(function () {
        Route::get('/user/{id}', 'UserController@getUserDetails');
        Route::patch('/user/{id}', 'UserController@updateUser');
    });

    Route::post('/logout', 'AuthController@logout');

});

Route::post('/login', 'AuthController@login');
Route::put('/register', 'AuthController@register');
