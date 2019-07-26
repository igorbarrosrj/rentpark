<?php
Route::group(['middleware' => 'web'], function() {

    Route::group(['as' => 'provider.', 'prefix' => 'provider'], function() {

        Route::get('/clear-cache', function() {

            $exitCode = Artisan::call('config:cache');

            return back();

        })->name('clear-cache');
/*
        Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');

        Route::post('login', 'Auth\AdminLoginController@login')->name('login.post');

        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

        Route::get('/', 'AdminController@index')->name('dashboard');
*/

    
        /***
         *
         * Hosts management
         *
         */       
        Route::get('/hosts/index', 'ProviderController@hosts_index')->name('hosts.index');

        Route::get('/hosts/create', 'ProviderController@hosts_create')->name('hosts.create');

        Route::get('/hosts/edit/{id}', 'ProviderController@hosts_edit')->name('hosts.edit');

        Route::post('/hosts/save', 'ProviderController@hosts_save')->name('hosts.save');

        Route::get('/hosts/view/{id}', 'ProviderController@hosts_view')->name('hosts.view');

        Route::get('/hosts/delete/{id}', 'ProviderController@hosts_delete')->name('hosts.delete');

        Route::get('/hosts/status/{id}', 'ProviderController@hosts_status')->name('hosts.status');


        

    });

});