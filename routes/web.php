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
    return view('welcome');
});

//To show admin panel view
// Route::view('/dashboard','admin.dashboard');

Route::resource('/admin','AdminController');

Route::get('/admin/user','AdminController@user_create');
/*Route::get('/users/destroy/{id}','UsersController@destroy');
Route::post('/users/update/{id}','UsersController@update');*/

Route::view('/admin_login','admin.auth.login');