<?php

 
Route::group(['middleware' => 'web'], function() {

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {

        Route::get('/clear-cache', function() {

            $exitCode = Artisan::call('config:cache');

            return back();

        })->name('clear-cache');

        Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');

        Route::post('login', 'Auth\AdminLoginController@login')->name('login.post');

        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

        Route::get('/', 'AdminController@index')->name('dashboard');


        /***
         *
         * Users management
         *
         */       
        Route::get('/users/index', 'AdminController@users_index')->name('users.index');

        Route::get('/users/create', 'AdminController@users_create')->name('users.create');

        Route::get('/users/edit/{id}', 'AdminController@users_edit')->name('users.edit');

        Route::post('/users/save', 'AdminController@users_save')->name('users.save');

        Route::get('/users/view/{id}', 'AdminController@users_view')->name('users.view');

        Route::get('/users/delete/{id}', 'AdminController@users_delete')->name('users.delete');

        
        /***
         *
         * Hosts management
         *
         */       
        Route::get('/hosts/index', 'AdminController@hosts_index')->name('hosts.index');

        Route::get('/hosts/create', 'AdminController@hosts_create')->name('hosts.create');

        Route::get('/hosts/edit/{id}', 'AdminController@hosts_edit')->name('hosts.edit');

        Route::post('/hosts/save', 'AdminController@hosts_save')->name('hosts.save');

        Route::get('/hosts/view/{id}', 'AdminController@hosts_view')->name('hosts.view');

        Route::get('/hosts/delete/{id}', 'AdminController@hosts_delete')->name('hosts.delete');


        /***
         *
         * Service Locations management
         *
         */       
        Route::get('/locations/index', 'AdminController@locations_index')->name('locations.index');

        Route::get('/locations/create', 'AdminController@locations_create')->name('locations.create');

        Route::get('/locations/edit/{id}', 'AdminController@locations_edit')->name('locations.edit');

        Route::post('/locations/save', 'AdminController@locations_save')->name('locations.save');

        Route::get('/locations/view/{id}', 'AdminController@locations_view')->name('locations.view');

        Route::get('/locations/delete/{id}', 'AdminController@locations_delete')->name('locations.delete');

    });

});
