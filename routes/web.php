<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('dashboard.index');
//});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout');

//proposals
Route::get('proposals', 'ProposalsController@index');
Route::get('proposals/{id}', 'ProposalsController@show');
Route::get('proposals/{id}/download','ProposalsController@download');
Route::post('proposals/{id}/accept','ProposalsController@accept');
Route::post('proposals/{id}/reject','ProposalsController@reject');
Route::get('proposals/{id}/create','ProposalsController@create');
Route::post('proposals/{id}/submission','ProposalsController@submission');
Route::put('proposals/{id}/update','ProposalsController@update');
