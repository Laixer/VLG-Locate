<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'HomeController@dashboard');
	Route::get('/sources', 'HomeController@sources');
	Route::get('/map', 'HomeController@map');
	Route::get('/board', 'HomeController@board');
	Route::get('/board/source', 'HomeController@boardSource');
	Route::get('/principal', 'HomeController@about');
});

Route::group(['middleware' => ['web', 'auth.edit']], function () {
	Route::get('/project/new', 'HomeController@projectNew');
	Route::get('/project/edit', 'HomeController@projectEdit');
	Route::get('/source/new', 'HomeController@sourceNew');
	Route::get('/source/delete', 'HomeController@sourceDelete');
	Route::get('/notepad', 'HomeController@notepad');
	Route::post('/project/new', 'HomeController@doProjectNew');
	Route::post('/project/update', 'HomeController@doProjectUpdate');
	Route::post('/source/new', 'HomeController@doSourceNew');
	Route::post('/notepad/update', 'HomeController@doNotepadUpdate');
});
