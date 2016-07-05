<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'welcome', function ()
{
    return view('pages.welcome');
}]);

// Authentication routes...
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/dashboard', ['as' => 'home', function ()
    {
        return view('pages.home');
    }]);

    Route::get('/letters', 'LetterController@index');
    Route::get('/emails', 'EmailController@index');

    Route::resource('customer.letter', 'LetterController');
    Route::resource('customer.email', 'EmailController');
    Route::post('customer/refresh', ['as' => 'customer.refresh', 'uses' => 'CustomerController@refresh']);

    Route::resource('customers', 'CustomerController');

    Route::resource('template', 'TemplateController');
});