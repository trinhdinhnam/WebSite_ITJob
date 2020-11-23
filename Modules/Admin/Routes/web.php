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

Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'job'], function(){
        Route::get('/','AdminJobController@index')->name('admin.get.list.job');
        Route::get('/create','AdminJobController@createJob')->name('admin.add.job');

    });
});
