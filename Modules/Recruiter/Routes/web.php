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
    Route::get('complete','RecruiterTransactionController@complete');
    Route::get('/', 'RecruiterController@index')->name('recruiter.home');
    Route::get('/logout','RecruiterAuthController@getLogout')->name('get.logout.recruiter');
    Route::get('/message/seeker/jobId={jobId}+seekerId={seekerId}','RecruiterController@getSeekerByMessage')->name('recruiter.get.seeker.by.message');

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
        Route::get('/register-account-package','RecruiterTransactionController@getRegisterAccountPackage')->name('recruiter.get.register.account.package');
        Route::get('/pay/order/accountId={accountId}','RecruiterTransactionController@getPay')->name('get.pay.order');
        Route::post('/pay/order/accountId={accountId}','RecruiterTransactionController@postPay');

    });

    Route::group(['prefix' => 'user'], function(){
        Route::get('/change-info/{id}','RecruiterUserController@getChangeInfo')->name('recruiter.get.change.info');
        Route::post('/change-info/{id}','RecruiterUserController@postChangeInfo')->name('recruiter.post.change.info');
        Route::get('/change-password/{id}','RecruiterUserController@getChangePassword')->name('recruiter.get.change.password');
        Route::post('/change-password/{id}','RecruiterUserController@postChangePassword')->name('recruiter.post.change.password');

    });
    Route::group(['prefix' => 'statistical'], function(){
        Route::get('/transaction/{recruiterId}','RecruiterStatisticalController@getTransaction')->name('recruiter.get.statistical.transaction');
        Route::get('/job/{recruiterId}','RecruiterStatisticalController@getJob')->name('recruiter.get.statistical.job');
        Route::get('/seeker/{recruiterId}','RecruiterStatisticalController@getSeeker')->name('recruiter.get.statistical.seeker');
        Route::get('/review/{recruiterId}','RecruiterStatisticalController@getReview')->name('recruiter.get.statistical.review');
    });
});
