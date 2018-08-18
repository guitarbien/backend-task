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

Route::group(['middleware' => 'auth.token'], function() {
    Route::get('/todos', 'TodoController@index');
    Route::get('/todos/{todo}', 'TodoController@show');
    Route::post('/todos', 'TodoController@store');
    Route::put('/todos/{todo}', 'TodoController@update');
    Route::delete('/todos/{todo}', 'TodoController@delete');
    Route::delete('/todos', 'TodoController@deleteBatch');

    Route::get('/token', 'TokenController@index');
    Route::put('/token/refresh', 'TokenController@update');
});

Route::post('/token', 'TokenController@store');
