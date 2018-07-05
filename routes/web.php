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
Route::get('old', 'IndexController@home')->name('home');
Route::get('/', 'IndexController@r_home')->name('home');

Route::get('order/gotopay/{id}', 'OrderController@gotopay');
Route::get('order/newFromSite', 'OrderController@newFromSite');
Route::get('order/update/', 'OrderController@update');

Route::get('doctor/{doctor}', function (\App\Doctor $doctor) {
    return redirect()->route('doctor.item', ['doctor' => $doctor->alias]);
});
//Route::get('doctors/{city?}/{skill?}', function (\App\City $city, \App\Skill $skill = null) {
//    return redirect()->route('doctors.list', ['skill' => $skill->alias ?? null]);
//});

Route::group(['prefix' => 'doctors', 'as' => 'all.doctors.'], function () {
    Route::get('/{skill?}', 'DoctorController@commonList')->name('list');
});
Route::get('medcenters', 'MedcenterController@list')->name('all.medcenters.list');

//Route::get('medcenters/{city?}', function (\App\City $city = null) {
//    return redirect()->route('medcenters.list');
//});
Route::get('medcenter/{medcenter}', function (\App\Medcenter $medcenter) {
    return redirect()->route('medcenter.item', ['medcenter' => $medcenter->alias]);
});

Route::group(['prefix' => '{city}'], function () {

    Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function () {
        Route::get('/{skill?}', 'DoctorController@list')->name('list');
    });
    Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
        Route::get('/{doctor}', 'DoctorController@item')->name('item');
        Route::get('/{doctor}/feedback', 'DoctorController@feedback')->name('feedback');
        Route::get('/{doctor}/comments', 'DoctorController@loadComments')->name('comments');
    });

    Route::group(['prefix' => 'medcenters', 'as' => 'medcenters.'], function () {
        Route::get('/{skill?}', 'MedcenterController@list')->name('list');
    });
    Route::group(['prefix' => 'medcenter', 'as' => 'medcenter.'], function () {
        Route::get('/{medcenter}', 'MedcenterController@item')->name('item');
        Route::get('/{medcenter}/comments', 'MedcenterController@loadComments')->name('comments');
    });

});

//Drugs **********************************************
Route::get('drugs/', 'DrugsController@list');
Route::get('drug/{id}', 'DrugsController@item');
//callback **********************************************
Route::get('callback/new/', 'CallbackController@newQuick');
Route::get('callback/newDoc/', 'CallbackController@newDoc')->name('callback.newDoc');
//***comments

Route::get('comment/new', 'CommentController@new');
Route::get('comment/{id}/rate/{rate}', 'CommentController@rateComment')->name('rateComment');
//******questions*****************
Route::post('question/add', 'QuestionController@add');
//******Posts***************************
Route::get('post/{alias}', 'PostController@item');
Route::get('posts', 'PostController@list');
//******redirects*****************
Route::get('/promos/almaty', function () {
    return Redirect::to('/', 302);
});
Route::get('/site/thank', function () {
    return Redirect::to('/', 302);
});
Route::get('/illness/almaty/all/', function () {
    return Redirect::to('/', 302);
});
//*********for pay*************

Route::get('setcity/{cityid}', 'BaseController@setcity');

Auth::routes();
Route::get('/login', 'Auth\LoginController@getLoginForm')->name('login');
Route::post('/register', 'Auth\RegisterController@registerUser')->name('register');

Route::group(['as' => 'password.', 'prefix' => 'password'], function () {
    Route::get('/phone/request', 'Auth\PhonePasswordResetController@showCodeRequestForm')->name('phone.request-form');
    Route::post('/phone/request', 'Auth\PhonePasswordResetController@requestResetCode')->name('phone.request');
    Route::get('/phone/code', 'Auth\PhonePasswordResetController@showCodeConfirmForm')->name('phone.code-confirm-form');
    Route::post('/phone/code', 'Auth\PhonePasswordResetController@confirmCode')->name('phone.code-confirm');
    Route::get('/phone/reset', 'Auth\PhonePasswordResetController@showPasswordResetForm')->name('phone.reset-form');
    Route::post('/phone/reset', 'Auth\PhonePasswordResetController@resetPassword')->name('phone.reset');
});

Route::get('/banner/{id}', 'BannerController@click')->name('banner.link');

//LIVESEARCH
Route::get('/ajax/search', 'SearchController@livesearch');
Route::get('/ajax/index_search', 'SearchController@livesearchIndex');

Route::get('/api/345168965432865/order/new/{phone}/{operator_id}', 'MightyCall\OrderController@getFormView')->name('api.order.form');
Route::post('/api/345168965432865/order/save', "MightyCall\OrderController@create")->name('api.order.create');
Route::get('/api/345168965432865/client/search', 'SearchController@searchClients')->name('api.client.search');
Route::get('/api/345168965432865/clients/withPhone', 'UserController@searchClientsByPhone')->name('api.client.byPhone');
Route::get('/api/345168965432865/users/search', 'UserController@search')->name('api.users.search');

Route::get('redirector', function (\Illuminate\Http\Request $request) {
    $data = $request->input('data');
    $redirectUrl = str_replace('chromeurl:', '', $data);
    return response()->redirectTo($redirectUrl);
});

Route::group(['as' => 'cabinet.', 'prefix' => 'cabinet'], function () {
    Route::group(['as' => 'doctor.', 'prefix' => 'doctor'], function () {
        Route::get('/', 'Cabinet\DoctorCabinetController@index');
        Route::post('/orderList', 'Cabinet\DoctorCabinetController@orderList')->name('orderList');
        Route::get('/orderDetails/{id?}', 'Cabinet\DoctorCabinetController@orderDetails')->name('orderDetails');
    });
});

Route::group(['as' => 'telegram.', 'prefix' => 'telegram'], function () {
    Route::any('{bottoken}/updates', 'Telegram\TelegramBotController@processUpdates');
});

Route::get('/search', 'SearchController@searchPage')->name('doctors.searchPage');

Route::post('/search/docotrs', 'SearchController@searchResults')->name('doctors.page');

Route::post('/feedback/leave', 'FeedbackController@create')->name('feedback.create');

Route::get('/feedback/order/{token}', 'OrderController@feedbackView')->name('feedback.order.view');
Route::post('/feedback/order/{token}', 'OrderController@feedbackLeave')->name('feedback.order.create');

Route::get('/{city}/specializacii/{skill}', 'SkillController@showSkillDoctors')->name('skill.doctors');


// Telegram doctors bot
Route::group(['as' => 'telegrambot.', 'prefix' => 'telegrambot'], function () {
    Route::get(
        '/info', 'TelegramBotController@info'
    );
    Route::get(
        '/set-webhook', 'TelegramBotController@setWebhook'
    );
    Route::get(
        '/remove-webhook', 'TelegramBotController@removeWebhook'
    );
    Route::post(
        '/callback', 'TelegramBotController@callback'
    );
});

