<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/movies/get-movies', 'MovieController@getList');
Route::get('/movies/create', 'MovieController@createRecord');
Route::post('/movies/store', 'MovieController@saveRecord');
Route::get('/movies/{movies}', 'MovieController@showRecord');
Route::get('/movies/{movieId}/edit', 'MovieController@editRecord');
Route::post('/movies/{movieId}/update', 'MovieController@updateRecord');

Route::post('/movies/{movieId}/delete', 'MovieController@deleteRecord');