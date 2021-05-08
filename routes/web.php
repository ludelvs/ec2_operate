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

Route::group(['middleware' => ['ip_limit', 'auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['ip_limit']], function() {
    Route::get('/', 'HomeController@index')->name('/');
    Route::post('start_ec2', 'HomeController@start_ec2')->name('start_ec2');
    Route::post('stop_ec2', 'HomeController@stop_ec2')->name('stop_ec2');
    Auth::routes();
});