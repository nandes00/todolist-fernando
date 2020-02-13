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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('tasks')->namespace('Tasks')->name('tasks.')->group(function(){

    Route::get('/task-list-urgent', 'TaskController@indexUrgentTasks')->name('urgent.list');
    Route::get('/task-list-medium', 'TaskController@indexMediumTasks')->name('medium.list');
    Route::get('/task-list-low', 'TaskController@indexLowTasks')->name('low.list');
    Route::get('/task-view/{id}', 'TaskController@show');
    Route::put('/task-edit/{id}', 'TaskController@update');
    Route::delete('/task-delete/{id}', 'TaskController@destroy');

    Route::post('/task-store', 'TaskController@store')->name('store');


});
