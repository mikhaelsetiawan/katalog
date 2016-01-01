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

		Route::group(['prefix' => '/business'], function () {
				Route::get('addBusiness','controller_business@addBusiness');
				Route::post('submitAddBusiness','controller_business@submitAddBusiness');
				Route::post('addNewBfield','controller_business@addNewBfield');
				Route::post('getProv','controller_business@getProv');
				Route::post('getCity','controller_business@getCity');

				Route::get('success','controller_business@successAddBusiness');
		});

		Route::group(['prefix' => 'backend'], function () {
				Route::get('member','backend\controller_member@index');
				Route::post('editMember','backend\controller_member@editMember');
				Route::post('resetPass','backend\controller_member@resetPass');

				Route::get('country','backend\controller_country@index');
				Route::post('editCountry','backend\controller_country@editCountry');

				Route::get('province','backend\controller_province@index');
				Route::post('editProvince','backend\controller_province@editProvince');

				Route::get('city','backend\controller_city@index');
				Route::post('editCity','backend\controller_city@editCity');

				Route::get('business','backend\controller_business@index');
				Route::post('editBusiness','backend\controller_business@editBusiness');

				Route::get('bfield','backend\controller_bfield@index');
				Route::post('editBfield','backend\controller_bfield@editBfield');

				Route::get('building','backend\controller_building@index');
				Route::post('editBuilding','backend\controller_building@editBuilding');

				Route::get('maff','backend\controller_maff@index');
				Route::post('editMaff','backend\controller_maff@editMaff');

				Route::get('admin','backend\controller_admin@index');
				Route::post('editAdmin','backend\controller_admin@editAdmin');
				Route::post('resetPass','backend\controller_admin@resetPass');
		});
});
