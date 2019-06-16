<?php

/**
 * JWT Authorization routes
 */

Route::name('auth-service.')
    ->prefix('auth')
    ->middleware('api')
    ->namespace('Diplodocker\Http\Controllers\Auth')->group(function () {
        Route::name('check')->get('check', 'CheckController@handle');
        Route::name('login')->post('login', 'LoginController@handle');
        Route::name('logout')->get('logout', 'LogoutController@handle');
        Route::name('register')->post('register', 'RegisterController@handle');
    });
