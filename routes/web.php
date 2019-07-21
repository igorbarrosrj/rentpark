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

Auth::routes();

Route::get('/addusers','AdminController@users_create');

Route::post('/storeusers','AdminController@users_store');

Route::get('/listusers','AdminController@users_index');

Route::get('/editusers/{id}','AdminController@users_edit');

Route::get('/showusers/{id}','AdminController@users_show');

Route::put('/updateusers/{id}','AdminController@users_update');

Route::get('/deleteusers/{id}','AdminController@users_destroy');

Route::view('/admin_login','admin.auth.login');