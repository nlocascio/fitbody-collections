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

Route::get('/', ['as' => 'home', function () {
    return view('pages.home');
}]);

Route::resource('customer.letter', 'LetterController');
Route::resource('customer.email', 'EmailController');
Route::post('customer/refresh', ['as' => 'customer.refresh', 'uses' => 'CustomerController@refresh']);
Route::resource('customer', 'CustomerController');
Route::resource('template', 'TemplateController');