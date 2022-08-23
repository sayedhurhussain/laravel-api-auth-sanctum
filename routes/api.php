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


Route::prefix('auth')->group(function () {
	Route::post('signup', 'App\Http\Controllers\AuthController@signup')->name('auth.signup');
	Route::post('login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
	Route::post('logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:sanctum')->name('auth.logout');
	Route::get('user', 'App\Http\Controllers\AuthController@getAuthenticatedUser')->middleware('auth:sanctum')->name('auth.user');

	Route::post('/password/email', 'App\Http\Controllers\AuthController@sendPasswordResetLinkEmail')->middleware('throttle:5,1')->name('password.email');
	Route::post('/password/reset', 'App\Http\Controllers\AuthController@resetPassword')->name('password.reset');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


