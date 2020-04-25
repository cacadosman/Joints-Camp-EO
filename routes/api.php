<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function() {
    Route::post('/user/register', [
        'uses' => 'AuthController@register'
    ]);
    Route::post('/user/login', [
        'uses' => 'AuthController@login'
    ]);
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/user/logout', 'AuthController@logout');
        Route::get('/user', 'AuthController@userCurrent');
        Route::get('/user/{id}', 'AuthController@userById');
        Route::get('/users', 'AuthController@usersAll');
    });
});