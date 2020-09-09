<?php

use Illuminate\Support\Facades\Route;

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


Route::prefix('/tweets')->group(function () {
    Route::get('/', 'PostController@index');
    Route::get('/{id}', 'PostController@show');
    Route::post('/', 'PostController@store');
    Route::delete('/{id}', 'PostController@delete');

    // likes
    Route::post('/{id}/like', 'PostController@like');
    Route::delete('/{id}/like/{like_id}', 'PostController@deslike');
});

Route::prefix('/comments')->group(function () {
    // Route::get('/', 'PostController@index');
    Route::post('/', 'CommentsController@store');
    Route::delete('/{id}', 'CommentsController@delete');
});
