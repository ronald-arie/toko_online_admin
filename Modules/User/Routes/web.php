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

Route::prefix('user')->group(function() {
    Route::get('/', 'UserController@index')->middleware('can:user.view');
    Route::get('/data', 'UserController@data')->middleware('can:user.view');
    Route::get('/add', 'UserController@form')->middleware('can:user.create');
    Route::post('/add', 'UserController@formProcess')->middleware('can:user.create');
    Route::get('/edit/{id}', 'UserController@form')->middleware('can:user.update');
    Route::post('/edit/{id}', 'UserController@formProcess')->middleware('can:user.update');
    Route::get('/delete/{id}', 'UserController@deleteProcess')->middleware('can:user.delete');
});
