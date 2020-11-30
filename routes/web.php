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
    return view('index');
});

Route::group(['prefix' => 'job'], function(){
    Route::get('/','HomeController@getJobs')->name('client.get.list.job');
    Route::get('/detail/{id}','HomeController@getDetailJob')->name('client.get.detail.job');
    Route::get('/job-by-company/{id}','HomeController@getJobByCompany')->name('client.get.job.bycompany');

});
