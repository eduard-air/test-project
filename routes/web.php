<?php

use App\Mail\ActivationFormMail;

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

Route::get('/', 'MainPageController@index')->name('main');

Auth::routes();

Route::group(['prefix' => 'profile', 'middleware' => 'auth','as' => 'profile.'], function () {

	Route::get('/not-activated', 'ProfileController@notActivatedShow')->name('not_activated');

	Route::get('/activation/{user}/{token}', 'ProfileController@activate')->name('activation');

	Route::get('/set-password', 'ProfileController@setPasswordShow')->name('set_password');
	Route::post('/set-password', 'ProfileController@setPassword');

	Route::get('/', 'ProfileController@index')->name('index');

});