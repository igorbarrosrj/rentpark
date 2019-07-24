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
         * Service Locations management
         *
         */       
        Route::get('/locations/index', 'AdminController@service_locations_index')->name('service_locations.index');

        Route::get('/locations/create', 'AdminController@service_locations_create')->name('service_locations.create');

        Route::get('/locations/edit/{id}', 'AdminController@service_locations_edit')->name('service_locations.edit');

        Route::post('/locations/save', 'AdminController@service_locations_save')->name('service_locations.save');

        Route::get('/locations/view/{id}', 'AdminController@service_locations_view')->name('service_locations.view');

        Route::get('/locations/delete/{id}', 'AdminController@service_locations_delete')->name('service_locations.delete');

        
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
         * Booking management
         *
         */       
        Route::get('/bookings/index', 'AdminController@bookings_index')->name('bookings.index');

        Route::get('/bookings/view/{id}', 'AdminController@bookings_view')->name('bookings.view');

        

    });

});
