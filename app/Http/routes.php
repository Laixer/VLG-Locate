<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('auth', 'AuthController@redirectToProvider');
	Route::get('auth/callback', 'AuthController@handleProviderCallback');
	Route::get('unauth', 'AuthController@unauth');
});

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'HomeController@dashboard');
	Route::get('/sources', 'HomeController@sources');
	Route::get('/map', 'HomeController@map');
	Route::get('/board', 'HomeController@board');
	Route::get('/principal', 'HomeController@about');
});

Route::group(['middleware' => ['web', 'auth.edit']], function () {
	Route::get('/project/new', 'HomeController@projectNew');
	Route::get('/project/edit', 'HomeController@projectEdit');
	Route::get('/source/new', 'HomeController@sourceNew');
	Route::get('/source/delete', 'HomeController@sourceDelete');
	Route::post('/project/new', 'HomeController@doProjectNew');
	Route::post('/project/update', 'HomeController@doProjectUpdate');
	Route::post('/source/new', 'HomeController@doSourceNew');
});
