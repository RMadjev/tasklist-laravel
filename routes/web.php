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

Route::get('/', 'DashboardController@index');

// actions on lists
Route::post('/list', 'ListController@store');
Route::post('/list/{id}/task', 'ListController@addTask')->where('id','[0-9]+');
Route::get('/list/{id}', 'ListController@show')->where('id','[0-9]+');
Route::patch('/list/{id}', 'ListController@update')->where('id','[0-9]+');
Route::delete('/list/{id}', 'ListController@destroy')->where('id','[0-9]+');

//actions on tasks
Route::patch('/task/{id}', 'TaskController@update')->where('id','[0-9]+');

