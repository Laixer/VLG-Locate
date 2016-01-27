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

});

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'HomeController@dashboard');
	Route::get('/project/new', 'HomeController@projectNew');
	Route::post('/project/new', 'HomeController@doProjectNew');
});