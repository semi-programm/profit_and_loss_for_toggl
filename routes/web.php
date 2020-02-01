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

Route::get('/', function (){
    return view('welcome');
});

Route::resource('user', 'UserController', ['only' => ['index', 'show', 'destroy']]);
Route::get('/project', 'ProjectController@index')->name('project');
// Route::get('/project/view', 'ProjectController@view');
