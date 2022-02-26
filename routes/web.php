<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/my-applications', 'ApplicationController@index')->name('application.index');
    Route::get('/submit-application', 'ApplicationController@add')->name('application.add');
    Route::post('/submit-application', 'ApplicationController@_add')->name('application._add');
    Route::get('/submit-application/{any}', 'ApplicationController@update')->name('application.update');
    Route::post('/submit-application/{any}', 'ApplicationController@_update')->name('application._update');

    Route::get('/applicants-list', 'ApplicationController@list')->name('application.list');
    Route::get('/applicants-list/{any}/{any2}', 'ApplicationController@_list')->name('application._list');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
