<?php

use App\Http\Resources\Todo as TodoResource;
use App\Todo;
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

Route::get('/todo/{id}', function (int $id) {
    return new TodoResource(Todo::find($id));
});

Route::get('/todos', function () {
    return TodoResource::collection(Todo::all());
});
