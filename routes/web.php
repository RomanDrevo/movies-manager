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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(

);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'api'], function (){
//    Route::get('/movies', 'MovieController@getList');
//    Route::get('/movies/create', 'MovieController@createRecord');
//    Route::post('/movies/store', 'MovieController@saveRecord');
//    Route::get('/movies/{movies}', 'MovieController@showRecord');
//    Route::get('/movies/{movies}/edit', 'MovieController@editRecord');
//    Route::post('/movies/{movies}/update', 'MovieController@updateRecord');
//
//    Route::post('/movies/{movieId}/delete', 'MovieController@deleteRecord');
});


