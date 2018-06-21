<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.10.2017
 * Time: 10:37
 */
Route::get('phone/verification', 'Auth\PhoneVerificationController@phoneVerification')->name('phone.verification.form');
Route::post('phone/requestCode', 'Auth\PhoneVerificationController@requestCode')->name('phone.verification.request');
Route::get('phone/checkCode', 'Auth\PhoneVerificationController@codeVerification')->name('phone.verification.check-form');
Route::post('phone/checkCode', 'Auth\PhoneVerificationController@verifyCode')->name('phone.verification.check');

Route::get('/profile', 'HomeController@index')->name('profile');
Route::post('/profile', 'Auth\ProfileController@update')->name('profile.update');

Route::get('/email_change', 'Auth\EmailController@changeView')->name('auth.email.changeView');
Route::get('/email_request', 'Auth\EmailController@requestView')->name('auth.email.requestView');
Route::post('/email_request', 'Auth\EmailController@request')->name('auth.email.request');
Route::get('/email_confirm/{token}', 'Auth\EmailController@confirm')->name('auth.email.confirm');

Route::get('/home', 'HomeController@index');