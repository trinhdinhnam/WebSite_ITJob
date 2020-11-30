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

Route::prefix('recruiter')->group(function() {
    Route::get('/', 'RecruiterController@index')->name('recruiter.home');

    Route::group(['prefix' => 'job'], function(){
        Route::get('/','RecruiterJobController@index')->name('recruiter.get.list.job');
        Route::get('/detail/{id}','RecruiterJobController@getDetailJob')->name('recruiter.get.detail.job');
        Route::get('/create','RecruiterJobController@create')->name('recruiter.get.create.job');
        Route::post('/create','RecruiterJobController@createpost');
        Route::get('/update/{id}','RecruiterJobController@edit')->name('recruiter.get.edit.job');
        Route::post('/update/{id}','RecruiterJobController@update');
        Route::get('/delete/{id}','RecruiterJobController@delete')->name('recruiter.get.delete.job');
    });
});
