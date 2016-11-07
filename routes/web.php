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

//theses
Route::get('theses', 'ThesesController@index');
Route::get('theses/{id}', 'ThesesController@show');
Route::post('theses/{id}/renew', 'ThesesController@renew');
Route::post('theses/{id}/finish', 'ThesesController@finish');
Route::get('theses/{id}/download', 'ThesesController@download');

//conselings
Route::get('conselings', 'ConselingsController@index');
Route::post('conselings/{id}/store/', 'ConselingsController@store');
Route::get('conselings/{id}/show/', 'ConselingsController@show');
Route::get('conselings/{id}/comments', 'ConselingsController@showComments');
Route::post('conselings/{id}/comments/store', 'ConselingsController@comment');

//Schedules
Route::get('schedules', 'SchedulesController@index');
Route::get('schedules/{id}', 'SchedulesController@show');
Route::post('schedules/{id}/store', 'SchedulesController@store');
Route::post('schedules/confrim', 'SchedulesController@confrim');
Route::delete('schedules/{id}/delete', 'SchedulesController@destroy');

// Files
Route::resource('files', 'FilesController', ['only' => ['store', 'show', 'destroy']]);