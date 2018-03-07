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

Route::get('/', 'GuitarsController@home');
Route::get('/choose', 'GuitarsController@choose');
Route::get('/{id}/view', 'GuitarsController@view');
Route::get('/roster', 'GuitarsController@index');
Route::post('/ranking', 'GuitarsController@ranking');

//POPULATE DATABASE
Route::get('/highlight-image', 'GuitarsController@addHighlightImage');
Route::get('/populate-database', 'GuitarsController@populateDatabase');