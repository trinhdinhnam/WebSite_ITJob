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

    Route::group(['prefix' => 'job'], function(){
            Route::get('/','AdminJobController@index')->name('admin.get.list.job');
            Route::get('/detail/{id}','AdminJobController@getDetailJob')->name('admin.get.detail.job');
            Route::get('/{action}/{id}','AdminJobController@action')->name('admin.get.action.job');

        });
        Route::group(['prefix' => 'recruiter'], function(){
            Route::get('/','AdminRecruiterController@index')->name('admin.get.list.recruiter');
            Route::get('/detail/{id}','AdminRecruiterController@getDetailRecruiter')->name('admin.get.detail.recruiter');
            Route::get('/{action}/{id}','AdminRecruiterController@action')->name('admin.get.action.recruiter');
            Route::get('/{actiontran}/{id}','AdminRecruiterController@actionTransaction')->name('admin.get.action.transaction');
        });

        Route::group(['prefix' => 'transaction'], function(){
            Route::get('/recruiter/{id}','AdminTransactionController@getTransactions')->name('admin.get.transaction');
        });
});
