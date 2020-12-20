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
Route::prefix('authenticate')->group(function(){
    Route::get('/login','RecruiterAuthController@getLogin')->name('recruiter.get.login');
    Route::post('/login','RecruiterAuthController@postLogin');
    Route::get('/signup','RecruiterAuthController@getSignUp')->name('recruiter.signup');
    Route::post('/sinup','RecruiterAuthController@submitRegister');
    Route::get('/account-package','RecruiterAuthController@getAccountPackage')->name('recruiter.account.package');
});

Route::prefix('recruiters')->middleware('CheckLoginRecruiter')->group(function() {
    Route::get('/', 'RecruiterController@index')->name('recruiter.home');
    Route::get('/logout','RecruiterAuthController@getLogout')->name('get.logout.recruiter');


    Route::group(['prefix' => 'job'], function(){
        Route::get('/','RecruiterJobController@index')->name('recruiter.get.list.job');
        Route::get('/detail/{id}','RecruiterJobController@getDetailJob')->name('recruiter.get.detail.job');
        Route::get('/create','RecruiterJobController@create')->name('recruiter.get.create.job');
        Route::post('/create','RecruiterJobController@createpost');
        Route::get('/update/{id}','RecruiterJobController@edit')->name('recruiter.get.edit.job');
        Route::post('/update/{id}','RecruiterJobController@update');
        Route::get('/delete/{id}','RecruiterJobController@delete')->name('recruiter.get.delete.job');

    });

    Route::group(['prefix' => 'seeker'], function(){
        Route::get('/seeker-by-job/{id}','RecruiterSeekerController@getSeekerByJob')->name('recruiter.get.seeker.by.job');
        Route::get('/seeker-by-job/detail/{id}','RecruiterSeekerController@getSeekerDetail')->name('recruiter.get.seeker.detail');
        Route::get('/{action}/{id}','RecruiterSeekerController@action')->name('recruiter.get.action.seeker.by.job');
    });

    Route::group(['prefix' => 'transaction'], function(){

        Route::get('/','RecruiterTransactionController@getTransactions')->name('recruiter.get.transaction');
        Route::get('bill','RecruiterTransactionController@getBill')->name('recruiter.get.bill');

    });
});
