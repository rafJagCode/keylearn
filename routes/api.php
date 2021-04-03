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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
	return true;
});

Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
Route::post('new-test', 'TestController@getNewTest');
Route::post('save-test-results', 'TestController@saveTestResults')->middleware('auth:sanctum');
Route::post('get-profile-results', 'TestController@getProfileResults');
Route::post('delete-test-results', 'TestController@deleteTestResults');
Route::post('get-profiles', 'ProfileController@getProfiles')->middleware('auth:sanctum');
Route::post('create-profile', 'ProfileController@createProfile')->middleware('auth:sanctum');
Route::post('delete-profile', 'ProfileController@deleteProfile')->middleware('auth:sanctum');
Route::post('update-profile', 'ProfileController@updateProfile');
Route::post('use-profile', 'ProfileController@useProfile')->middleware('auth:sanctum');
