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
    Route::post('login','LoginController@postLogin')->name('seeker.post.login');
    Route::get('logout','LoginController@getLogout')->name('seeker.get.logout');
    Route::get('register','LoginController@getRegister')->name('seeker.get.register');
    Route::post('register','LoginController@postRegister')->name('seeker.post.register');
});

Route::group(['prefix' => 'job'], function(){
    Route::get('/','HomeController@getJobs')->name('client.get.list.job');
    Route::get('/detail/{id}','HomeController@getDetailJob')->name('client.get.detail.job');
    Route::get('/job-by-company/{id}','HomeController@getJobByCompany')->name('client.get.job.by.company');
    Route::get('/job-by-position/{id}','HomeController@getJobByPosition')->name('client.get.job.by.position');
    Route::get('/job-by-city/{id}','HomeController@getJobByCity')->name('client.get.job.by.city');
    Route::get('/job-by-position/{id}','HomeController@getJobByPosition')->name('client.get.job.by.position');
});

Route::group(['prefix' => 'apply','middleware' => 'CheckLoginSeeker'], function(){
    Route::get('/apply-job/{id}','ApplyController@getApply')->name('client.get.apply');
    Route::post('/apply-job/{id}','ApplyController@postApply');
});

Route::group(['prefix' => 'message','middleware' => 'CheckLoginSeeker'], function(){
    Route::get('/job/{id}','MessageController@getJobByMessage')->name('client.get.job.by.message');
});

Route::group(['prefix' => 'user', 'middleware' => 'CheckLoginSeeker'], function(){
    Route::get('/jobApply/{id}','UserController@getJobApply')->name('client.get.job.apply');
    Route::get('/change-info/{id}','UserController@getChangeInfo')->name('client.get.change.info');
    Route::post('/change-info/{id}','UserController@postChangeInfo')->name('client.post.change.info');
    Route::get('/change-password/{id}','UserController@getChangePassword')->name('client.get.change.password');
    Route::post('/change-password/{id}','UserController@postChangePassword')->name('client.post.change.info');

});
Route::group(['prefix' => 'review', 'middleware' => 'CheckLoginSeeker'], function(){
    Route::post('/recruiter/{id}','ReviewController@saveReview')->name('client.post.review');
});


