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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/tweets')->group(function ($route) {
    $route->get('/', 'PostController@index');
    $route->get('/{id}', 'PostController@show');
    $route->post('/', 'PostController@store');
    $route->delete('/{id}', 'PostController@delete');

    // likes
    $route->post('/{id}/like', 'PostController@like');
    $route->delete('/{id}/like/{like_id}', 'PostController@deslike');
});

Route::prefix('/comments')->group(function ($route) {
    // $route->get('/', 'PostController@index');
    $route->post('/', 'CommentsController@store');
    $route->delete('/{id}', 'CommentsController@delete');
});
