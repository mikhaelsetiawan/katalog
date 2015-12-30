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

		Route::group(['prefix' => 'backend'], function () {
				Route::get('member','backend\controller_member@index');
				Route::post('editMember','backend\controller_member@editMember');

				Route::get('country','backend\controller_country@index');
				Route::post('editCountry','backend\controller_country@editCountry');

				Route::get('province','backend\controller_province@index');
				Route::post('editProvince','backend\controller_province@editProvince');

				Route::get('city','backend\controller_city@index');
				Route::post('editCity','backend\controller_city@editCity');
		});
});
