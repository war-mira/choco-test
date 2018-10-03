<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.02.2018
 * Time: 12:50
 */
Route::get('/dashboard', 'Seo\DashboardController@dashboard')->name('dashboard');

Route::group(['as' => 'doctors.', 'prefix' => 'doctorss'], function () {
    Route::get('table', 'Seo\DoctorController@tableView')->name('table.view');
    Route::post('table', 'Seo\DoctorController@tableData')->name('table.data');
    Route::get('form/{id?}', 'Seo\DoctorController@formView')->name('form.view');
    Route::post('form/{id?}', 'Seo\DoctorController@formSave')->name('form.save');
});

Route::group(['as' => 'medcenters.', 'prefix' => 'medcenterss'], function () {
    Route::get('table', 'Seo\MedcenterController@tableView')->name('table.view');
    Route::post('table', 'Seo\MedcenterController@tableData')->name('table.data');
    Route::get('form/{id?}', 'Seo\MedcenterController@formView')->name('form.view');
    Route::post('form/{id?}', 'Seo\MedcenterController@formSave')->name('form.save');
});

Route::group(['as' => 'skills.', 'prefix' => 'skillss'], function () {
    Route::get('table', 'Seo\SkillController@tableView')->name('table.view');
    Route::post('table', 'Seo\SkillController@tableData')->name('table.data');
    Route::get('form/{id?}', 'Seo\SkillController@formView')->name('form.view');
    Route::post('form/{id?}', 'Seo\SkillController@formSave')->name('form.save');
});

Route::group(['as' => 'pageseo.', 'prefix' => 'pageseo'], function () {
    Route::get('table', 'Seo\PageSeoController@tableView')->name('table.view');
    Route::post('table', 'Seo\PageSeoController@tableData')->name('table.data');
    Route::get('form/{id?}', 'Seo\PageSeoController@formView')->name('form.view');
    Route::post('form/{id?}', 'Seo\PageSeoController@formSave')->name('form.save');
});
