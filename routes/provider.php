<?php
Route::group(['middleware' => 'web'], function() {

    Route::group(['as' => 'provider.', 'prefix' => ''], function() {

        Route::get('/clear-cache', function() {

            $exitCode = Artisan::call('config:cache');

            return back();

        })->name('clear-cache');

        Route::get('login', 'Auth\ProviderLoginController@showLoginForm')->name('login');

        Route::post('login', 'Auth\ProviderLoginController@login')->name('login.post');

        Route::get('register', 'Auth\ProviderRegisterController@showRegisterForm')->name('register');

        Route::post('register', 'Auth\ProviderRegisterController@register')->name('register.post');

        Route::post('logout', 'Auth\ProviderLoginController@logout')->name('logout');

        Route::get('/', 'ProviderController@index')->name('dashboard');

        //password reset Routes
        Route::post('/password/email','Auth\ProviderForgotPasswordController@sendResetLinkEmail')->name('password.email');

        Route::get('/password/reset','Auth\ProviderForgotPasswordController@showLinkRequestForm')->name('password.request');

        Route::post('/password/reset','Auth\ProviderResetPasswordController@reset');

        Route::get('/password/reset/{token}','Auth\ProviderResetPasswordController@showResetForm')->name('password.reset');


    
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


        /***
         *
         * Profile management
         *
         */       

        Route::get('/profile/edit/{id}', 'ProviderController@profile_edit')->name('profile.edit');

        Route::post('/profile/save', 'ProviderController@profile_save')->name('profile.save');

        Route::get('/profile/view', 'ProviderController@profile_view')->name('profile.view');

        Route::get('/profile/delete/{id}', 'ProviderController@profile_delete')->name('profile.delete');

        Route::get('/profile/password/', 'ProviderController@profile_password')->name('profile.password');

        Route::post('/profile/password/save', 'ProviderController@profile_password_save')->name('profile.password.save');


    });

});