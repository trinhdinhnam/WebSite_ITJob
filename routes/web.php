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
Route::get('/','HomeController@getHomePage')->name('client.get.home.page');

Route::get('search','HomeController@getJobs')->name('client.search.job');
Route::get('confirm-recruiter','HomeController@getConfirm')->name('client.confirm.recruiter');
Route::group(['namespace' => 'Auth'],function(){
    Route::get('login','LoginController@getLogin')->name('seeker.get.login');
});
Route::group(['prefix' => 'job'], function(){
    Route::get('/','HomeController@getJobs')->name('client.get.list.job');
    Route::get('/detail/{id}','HomeController@getDetailJob')->name('client.get.detail.job');
    Route::get('/job-by-company/{id}','HomeController@getJobByCompany')->name('client.get.job.by.company');
    Route::get('/job-by-position/{id}','HomeController@getJobByPosition')->name('client.get.job.by.position');
});

Route::group(['prefix' => 'apply'], function(){
    Route::get('/apply-job/{id}','ApplyController@getApply')->name('client.get.apply');

});
