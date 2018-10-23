<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2017
 * Time: 16:39
 */
//*******************Administrator

Route::any('/', 'AdminController@dashboard');
Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

Route::get('/clients/search', 'SearchController@searchClients');
Route::get('/ajax/autocomplete','SearchController@autocomplete');
Route::get('/ajax/doctor/medcenters','AdminController@getDoctorMedcenters');
Route::post('/ajax/image/upload','Admin\ImageController@upload');

Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::get('/', 'Admin\SettingsController@form')->name("form");
    Route::post('/form/update', 'Admin\SettingsController@update')->name("update");
});

Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::get('/', 'Admin\SettingsController@form')->name("form");
    Route::post('/form/update', 'Admin\SettingsController@update')->name("update");
});

Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard'], function () {
    Route::get('/getNotifications', 'Admin\DashboardNotificationController@getNotifications');
    Route::get('/openNotification/{id}', 'Admin\DashboardNotificationController@openNotification')->name('openNotification');
});

Route::group(['as' => 'notifications.'], function () {
    Route::get('notifications/for', 'Admin\NotificationController@getForDate')->name('forDate');
    Route::post('notifications/{id}/save', 'Admin\NotificationController@save')->name('save');
});
Route::group(['as' => 'medcenters.'], function () {
    Route::get('medcenter/setstatus', 'Admin\MedcenterController@setStatus')->name('setstatus');
    Route::get('medcenters/form/{id?}', 'Admin\MedcenterController@getFormView')->name('form');
    Route::get('medcenters/table', 'Admin\MedcenterController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {
        Route::get('medcenters/{id?}', 'Admin\MedcenterController@get')->name('get');
        Route::post('medcenters', 'Admin\MedcenterController@create')->name('create');
        Route::post('medcenters/{id}', 'Admin\MedcenterController@update')->name('update');
        Route::delete('medcenters/{id}', 'Admin\MedcenterController@delete')->name('delete');
    });
});


Route::group(['as' => 'doctors.'], function () {
    Route::get('doctors/form/{id?}', 'Admin\DoctorController@getFormView')->name('form');
    Route::get('doctors/forms/skill-row', 'Admin\DoctorController@getSkillRow')->name('forms.skill-row');
    Route::post('import/doctors/{id?}', 'Admin\DoctorImportController@importExcel')->name('import');
    Route::get('doctors/table', 'Admin\DoctorController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {
        Route::get('doctors/{id?}', 'Admin\DoctorController@get')->name('get');
        Route::post('doctors', 'Admin\DoctorController@create')->name('create');
        Route::post('doctors/{id}', 'Admin\DoctorController@update')->name('update');
        Route::delete('doctors/{id}', 'Admin\DoctorController@delete')->name('delete');
    });
});


Route::group(['as' => 'skills.'], function () {
    Route::get('skills/form/{id?}', 'Admin\SkillController@getFormView')->name('form');
    Route::get('skills/table', 'Admin\SkillController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('skills/{id?}', 'Admin\SkillController@get')->name('get');
        Route::post('skills', 'Admin\SkillController@create')->name('create');
        Route::post('skills/{id}', 'Admin\SkillController@update')->name('update');
        Route::delete('skills/{id}', 'Admin\SkillController@delete')->name('delete');
    });
});
Route::group(['as' => 'page_notifications.'], function () {
    Route::get('page_notifications/form/{id?}', 'PageNotificationController@getFormView')->name('form');
    Route::post('page_notifications/preview', 'PageNotificationController@getPreview')->name('preview');

    Route::get('page_notifications/table', 'PageNotificationController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('page_notifications/{id?}', 'PageNotificationController@get')->name('get');
        Route::post('page_notifications', 'PageNotificationController@create')->name('create');
        Route::post('page_notifications/{id}', 'PageNotificationController@update')->name('update');
        Route::delete('page_notifications/{id}', 'PageNotificationController@delete')->name('delete');
    });
});
Route::group(['as' => 'orders.'], function () {
    Route::get('orders/notifications/{id}', 'Admin\OrderController@getNotifications')->name('notifications.get');
    Route::post('orders/notifications/{id}/create', 'Admin\OrderController@createNotification')->name('notifications.create');
    Route::post('orders/notifications/{id}/create', 'Admin\OrderController@createNotification')->name('notifications.create');
    Route::get('orders/form/{id?}', 'Admin\OrderController@getFormView')->name('form');
    Route::get('orders/table', 'Admin\OrderController@getTableView')->name('table');
    Route::get('orders/export', 'Admin\OrderController@export')->name('export');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('orders/{id?}', 'Admin\OrderController@get')->name('get');
        Route::post('orders', 'Admin\OrderController@create')->name('create');
        Route::post('orders/{id}', 'Admin\OrderController@update')->name('update');
        Route::delete('orders/{id}', 'Admin\OrderController@delete')->name('delete');
    });
});

Route::group(['as' => 'posts.'], function () {
    Route::get('posts/form/{id?}', 'Admin\PostController@getFormView')->name('form');
    Route::get('posts/table', 'Admin\PostController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('posts/{id?}', 'Admin\PostController@get')->name('get');
        Route::post('posts', 'Admin\PostController@create')->name('create');
        Route::post('posts/{id}', 'Admin\PostController@update')->name('update');
        Route::delete('posts/{id}', 'Admin\PostController@delete')->name('delete');
    });
});

Route::group(['as' => 'illnesses-groups.'], function () {
    Route::get('illnesses-groups/form/{id?}', 'Admin\IllnessesGroupController@getFormView')->name('form');
    Route::get('illnesses-groups/table', 'Admin\IllnessesGroupController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {
        Route::get('illnesses-groups/{id?}', 'Admin\IllnessesGroupController@get')->name('get');
        Route::post('illnesses-groups', 'Admin\IllnessesGroupController@create')->name('create');
        Route::post('illnesses-groups/{id}', 'Admin\IllnessesGroupController@update')->name('update');
        Route::delete('illnesses-groups/{id}', 'Admin\IllnessesGroupController@delete')->name('delete');
    });
});

Route::group(['as' => 'illnesses.'], function () {
    Route::get('illnesses/form/{id?}', 'Admin\IllnessesController@getFormView')->name('form');
    Route::get('illnesses/table', 'Admin\IllnessesController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {
        Route::get('illnesses/{id?}', 'Admin\IllnessesController@get')->name('get');
        Route::post('illnesses', 'Admin\IllnessesController@create')->name('create');
        Route::post('illnesses/{id}', 'Admin\IllnessesController@update')->name('update');
        Route::delete('illnesses/{id}', 'Admin\IllnessesController@delete')->name('delete');
    });
});

Route::group(['as' => 'illnesses-articles.'], function () {
    Route::get('illnesses-articles/form/{id?}', 'Admin\IllnessesGroupArticlesController@getFormView')->name('form');
    Route::get('illnesses-articles/table', 'Admin\IllnessesGroupArticlesController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {
        Route::get('illnesses-articles/{id?}', 'Admin\IllnessesGroupArticlesController@get')->name('get');
        Route::post('illnesses-articles', 'Admin\IllnessesGroupArticlesController@create')->name('create');
        Route::post('illnesses-articles/{id}', 'Admin\IllnessesGroupArticlesController@update')->name('update');
        Route::delete('illnesses-articles/{id}', 'Admin\IllnessesGroupArticlesController@delete')->name('delete');
    });
});

Route::group(['as' => 'callbacks.'], function () {
    Route::get('callbacks/form/{id?}', 'Admin\CallbackController@getFormView')->name('form');
    Route::get('callbacks/table', 'Admin\CallbackController@getTableView')->name('table');
    Route::get('callbacks/orderFrom/{id}', 'Admin\CallbackController@createOrderFrom')->name('orderFrom');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('callbacks/{id?}', 'Admin\CallbackController@get')->name('get');
        Route::post('callbacks', 'Admin\CallbackController@create')->name('create');
        Route::post('callbacks/{id}', 'Admin\CallbackController@update')->name('update');
        Route::delete('callbacks/{id}', 'Admin\CallbackController@delete')->name('delete');
    });
});

Route::group(['as' => 'banner.'], function () {
    Route::get('banners/statistics', 'BannerController@showStatistics')->name('statistics');
    Route::get('banners/list/', 'BannerController@list')->name('list');
    Route::post('banner/create', ['as' => 'ajax', 'uses' => 'BannerController@create'])->name('create');
    Route::post('banner/update/{id}', 'BannerController@update')->name('update');
    Route::delete('banner/delete/{id}', 'BannerController@delete')->name('delete');
});


Route::group(['as' => 'report.'], function () {
    Route::get('reports/order/{startdate?}/{enddate?}', 'ReportController@daily')->name('daily');
    Route::get('reports/clinic/{startdate?}/{enddate?}/{medcenterid?}', 'ReportController@clinic_order')->name('medcenter');
    Route::get('reports/clinic_excel/{startdate?}/{enddate?}/{medcenterid?}', 'ReportController@clinic_excel')->name('excel');
    Route::get('reports/doctor/{startdate?}/{enddate?}/{doctorid?}', 'ReportController@doctor_order')->name('doctor');
    Route::get('reports/month', 'ReportController@monthForm')->name('monthForm');
    Route::get('reports/month/report', 'ReportController@reportForMonth')->name('reportForMonth');
    Route::get('reports/month/operator', 'ReportController@operatorForMonth')->name('operatorForMonth');
    Route::get('reports/month/medcenter', 'ReportController@medcenterForMonth')->name('medcenterForMonth');
    Route::get('reports/doctors-clicks', 'ReportController@doctorsClicks')->name('doctorsClicks');
    Route::get('reports/doctors-clicks-report', 'ReportController@makeDoctorsClickReports')->name('makeDoctorsClickReports');
    Route::get('reports/doctor-views/{id}', 'ReportController@getDoctorsViewsById')->name('makeDoctorsClickReports');
    Route::get('reports/doctors-views', 'ReportController@getDoctorsViews')->name('getDoctorsViews');

    Route::get('reports/buyers', 'Admin\Report\BuyersReportController@page')->name('buyers.page');
    Route::post('reports/buyers', 'Admin\Report\BuyersReportController@report')->name('buyers.report');
});

Route::group(['as' => 'comments.'], function () {
    Route::get('comment/setstatus/', 'Admin\CommentController@set_status')->name('status.set');
    Route::get('comments/{id}/reply', 'Admin\CommentController@reply')->name('reply');
    Route::get('comments/{id}/delete', 'Admin\CommentController@delete')->name('delete');
    Route::get('comments/form/{id?}', 'Admin\CommentController@getFormView')->name('form');
    Route::get('comments/table', 'Admin\CommentController@getTableView')->name('table');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('comments/{id?}', 'Admin\CommentController@get')->name('get');
        Route::post('comments', 'Admin\CommentController@create')->name('create');
        Route::post('comments/{id}', 'Admin\CommentController@update')->name('update');
        Route::delete('comments/{id}', 'Admin\CommentController@delete')->name('delete');
    });
    Route::group(['as' => 'statistics.', 'prefix' => 'comments/statistics'], function () {
        Route::get('skills', 'Admin\CommentStatisticsController@commentsBySkills')->name('skills');
        Route::get('doctors', 'Admin\CommentStatisticsController@commentsByDoctors')->name('doctors');
        Route::get('medcenters', 'Admin\CommentStatisticsController@commentsByMedcenters')->name('medcenters');
        Route::get('all', 'Admin\CommentStatisticsController@allStatistics')->name('all');
    });
});

Route::group(['as' => 'comment-reply.', 'prefix' => 'comment_reply'], function () {
    Route::post('create', 'CommentReplyController@create')->name('create');
    Route::post('save', 'CommentReplyController@save')->name('save');
    Route::post('delete', 'CommentReplyController@delete')->name('delete');
});

Route::group(['as' => 'users.'], function () {
    Route::get('users/table', 'UserController@getTableView')->name('table');
    Route::get('users/form/{name?}/{id?}', 'UserController@getForm')->name('form');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('users/{id?}', 'UserController@get')->name('get');
        Route::post('users', 'UserController@saveOrderUser')->name('saveOrderUser');
        Route::delete('users/{id}', 'UserController@delete')->name('delete');
    });
});

Route::group(['as' => 'feedbacks.'], function () {
    Route::get('feedbacks/table', 'Admin\FeedbackController@getTableView')->name('table');
    Route::get('feedbacks/form/{name?}/{id?}', 'Admin\FeedbackController@getForm')->name('form');
    Route::group(['as' => 'crud.', 'prefix' => 'crud'], function () {

        Route::get('feedbacks/{id?}', 'Admin\FeedbackController@get')->name('get');
        Route::post('feedbacks/{id?}', 'Admin\FeedbackController@save')->name('save');
        Route::delete('feedbacks/{id}', 'Admin\FeedbackController@delete')->name('delete');
    });
});
Route::group(['as' => 'medcenter-reports.', 'prefix' => 'medcenter_reports'], function () {
    Route::get('/tableGet', 'Admin\MedcenterReportController@get')->name('get');
    Route::get('/form', 'Admin\MedcenterReportController@getFormView')->name('form');
    Route::post('/create', 'Admin\MedcenterReportController@create')->name('create');
    Route::get('/table', 'Admin\MedcenterReportController@getTableView')->name('table');
    Route::get('group/{id?}', 'Admin\MedcenterReportController@groupView')->name('group.view');
    Route::get('report/{id}/process', 'Admin\MedcenterReportController@processReport')->name('report.process');
    Route::get('report/{id}/send', 'Admin\MedcenterReportController@sendReport')->name('report.send');
    Route::post('report/{id}/save', 'Admin\MedcenterReportController@saveReport')->name('report.save');
});
