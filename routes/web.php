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

Route::resource('user', 'UserController', ['only' => ['index', 'show', 'destroy']]);
Route::resource('project', 'ProjectController', ['only' => ['index', 'update']]);
Route::resource('client', 'ClientController', ['only' => ['index', 'update']]);

Route::get('/', 'HomeController@index');
