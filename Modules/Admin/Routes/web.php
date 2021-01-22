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
    Route::get('/admin-login','AdminAuthController@getLogin')->name('admin.get.login');
    Route::post('/admin-login','AdminAuthController@postLogin');
});

Route::prefix('admin-manager')->middleware('CheckLoginAdmin')->group(function (){
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::get('/logout','AdminController@getLogout')->name('get.logout.admin');
    Route::get('/message/recruiter/recruiterId={recruiterId}+tranId={transactionId}','AdminController@getRecruiterByMessage')->name('admin.get.recruiter.by.message');


    Route::group(['prefix' => 'job'], function(){
            Route::get('/','AdminJobController@index')->name('admin.get.list.job');
            Route::get('/detail/{id}','AdminJobController@getDetailJob')->name('admin.get.detail.job');
            Route::get('/{action}/{id}','AdminJobController@action')->name('admin.get.action.job');

    });
        Route::group(['prefix' => 'recruiter'], function(){
            Route::get('/','AdminRecruiterController@index')->name('admin.get.list.recruiter');
            Route::get('/detail/{id}','AdminRecruiterController@getDetailRecruiter')->name('admin.get.detail.recruiter');
            Route::get('/{action}/{id}','AdminRecruiterController@action')->name('admin.get.action.recruiter');
        });

        Route::group(['prefix' => 'transaction'], function(){
            Route::get('/recruiter/{id}','AdminTransactionController@getTransactions')->name('admin.get.transaction');
            Route::get('/{action}/{id}','AdminTransactionController@actionTransaction')->name('admin.get.action.transaction');
            Route::get('/{transactionId}','AdminTransactionController@getDetailTransaction')->name('admin.get.detail.transaction');
        });

    Route::group(['prefix' => 'statistical'], function(){
        Route::get('/revenue','AdminStatisticalController@getRevenue')->name('admin.get.statistical.revenue');
        Route::get('/job','AdminStatisticalController@getJob')->name('admin.get.statistical.job');
        Route::get('/member','AdminStatisticalController@getMember')->name('admin.get.statistical.member');
        Route::get('/review','AdminStatisticalController@getReview')->name('admin.get.statistical.review');

    });


});
