<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.2018
 * Time: 14:54
 */
Route::group(['prefix' => '{city}'], function () {

    Route::group(['prefix' => 'doctors', 'name' => 'doctors'], function () {
        Route::get('/{skill?}', 'DoctorController@list')->name('list');
    });
    Route::group(['prefix' => 'doctor', 'name' => 'doctor'], function () {
        Route::get('/{doctor}', 'DoctorController@item')->name('item');
        Route::get('/{doctor}/comments', 'DoctorController@loadComments')->name('comments');
    });


    Route::group(['prefix' => 'medcenters', 'name' => 'doctors'], function () {
        Route::get('/{skill?}', 'MedcenterController@list')->name('list');
    });
    Route::group(['prefix' => 'medcenter', 'name' => 'medcenter'], function () {
        Route::get('/{medcenter}', 'MedcenterController@item')->name('item');
        Route::get('/{medcenter}/comments', 'MedcenterController@loadComments')->name('comments');
    });

});