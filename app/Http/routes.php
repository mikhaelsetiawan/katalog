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
Route::get('/','controller_frontend@index');
Route::get('/backend','controller_backend@index');
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
		Route::group(['prefix' => '/'], function () {
				Route::get('register','controller_frontend@register');
				Route::post('register','controller_frontend@submitRegister');
				Route::get('login','controller_frontend@login');
				Route::post('login','controller_frontend@authLogin');
		});
});
