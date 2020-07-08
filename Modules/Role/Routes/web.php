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

Route::prefix('role')->group(function() {
    Route::get('/', 'RoleController@index')->middleware('can:role.view');
    Route::get('/data', 'RoleController@data')->middleware('can:role.view');
    Route::get('/add', 'RoleController@form')->middleware('can:role.create');
    Route::post('/add', 'RoleController@formProcess')->middleware('can:role.create');
    Route::get('/edit/{id}', 'RoleController@form')->middleware('can:role.update');
    Route::post('/edit/{id}', 'RoleController@formProcess')->middleware('can:role.update');
});
