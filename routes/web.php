<?php


Auth::routes();

Route::get('/schedule','HomeController@schedule')->name('schedule');
Route::get('/','HomeController@redirectt');
Route::group(['middleware' => ['auth:web'], 'prefix' => 'user'],function ()
{
    Route::get('/','HomeController@index')->name('home');
    Route::POST('/monitor','HomeController@monitor');
    //delete
    Route::POST('/delete','HomeController@delete')->name('monitoring_destroy');
    //delete
    /*ajax*/
    Route::POST('/monitoring/','HomeController@monitoring')->name('monitoring');
    Route::POST('/buyback','HomeController@buyback')->name('buyback');
    /*ajax*/
    //payment
    //Route::get('/payment_checker','HomeController@payment_checker');
    //payment
    Route::get('/showmonitor/{user}','HomeController@showmonitor')->name('showmonitor');

});