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

/**
 * TaskController
 */
Route::get('/', 'TaskController@index');

Route::get('/tasks', 'TaskController@index');

Route::post('/task', 'TaskController@store');

Route::delete('/task/{task}', 'TaskController@destroy');

Route::patch('/task/{task}', 'TaskController@edit');

/**
 * GroupController
 */
Route::get('/groups', 'GroupController@index');
Route::post('/group', 'GroupController@store');
Route::delete('/group/{group}', 'GroupController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');