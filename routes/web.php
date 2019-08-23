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

Route::get('/', function () {
    return view('home');
});

Route::get('terms', function () {
    return view('layouts.users.terms');
})->name('terms');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


/**
*
* Users
*
**/

/***
 *
 * Profile management
 *
 */       

Route::get('/profile/edit/{id}', 'UserController@profile_edit')->name('profile.edit');

Route::post('/profile/save', 'UserController@profile_save')->name('profile.save');

Route::get('/profile/view', 'UserController@profile_view')->name('profile.view');

Route::get('/profile/delete/{id}', 'UserController@profile_delete')->name('profile.delete');

Route::get('/profile/password/', 'UserController@profile_password')->name('profile.password');

Route::post('/profile/password/save', 'UserController@profile_password_save')->name('profile.password.save');


/**
*
* Booking Management
*
**/


	Route::post('/bookings/save/{id}', 'UserController@bookings_save')->name('bookings.save');

	Route::get('/bookings/index', 'UserController@bookings_index')->name('bookings.index');

    Route::get('/bookings/view/{id}', 'UserController@bookings_view')->name('bookings.view');

    Route::get('/bookings/status/{id}', 'UserController@bookings_status')->name('bookings.status');

    Route::post('/bookings/rating/{id}', 'UserController@bookings_rating')->name('bookings.rating');


/***
*
* Hosts management
*
*/       
Route::get('/hosts/index', 'UserController@hosts_index')->name('hosts.index');

Route::get('/hosts/view/{id}', 'UserController@hosts_view')->name('hosts.view');

