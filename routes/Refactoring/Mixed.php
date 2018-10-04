<?php

Route::group(['namespace' => 'Refactoring', 'prefix' => 'refactoring', 'as' => 'refactoring.'], function () {
    Route::get('get-schedule-records/{doctor}', 'MixedController@getScheduleRecords')->name('get-schedule-records');

    Route::post('store-callback/{doctor}', 'MixedController@storeCallback')->name('store-callback');
    Route::post('store-appointment/{doctor}', 'MixedController@storeAppointment')->name('store-appointment');
});

