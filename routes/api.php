<?php

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

Route::get('/todos', 'TodoController@index');
Route::get('/todos/{todo}', 'TodoController@show');
Route::post('/todos', 'TodoController@store');
Route::put('/todos/{todo}', 'TodoController@update');
Route::delete('/todos/{todo}', 'TodoController@delete');

Route::get('/token', 'TokenController@index');
Route::post('/token', 'TokenController@store');
Route::put('/token/refresh', 'TokenController@update');
