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

Route::get('/cabinet/user/edit', function () {
    return view('cabinet.user.edit');
});

Route::get('/', 'IndexController@home')->name('home');

Route::get('resize', 'ImageController@resizeImages');

Route::get('likes','IndexController@ratings')->name('rates');

Route::get('allow-ip','IndexController@allowMyIp')->name('add-ip');

Route::get('order/gotopay/{id}', 'OrderController@gotopay');
Route::get('order/newFromSite', 'OrderController@newFromSite');
Route::get('order/update/', 'OrderController@update');
Route::post('getdata', 'DoctorController@getall');
Route::get('get_doc_time', 'DoctorController@get_dt')->name('get_dt');

Route::get('doctor/{doctor}', function (\App\Doctor $doctor) {
    return redirect()->route('doctor.item', ['doctor' => $doctor->alias], 301);
});

Route::group(['prefix' => 'doctors', 'as' => 'all.doctors.'], function () { //Добавил z - удалить
    Route::get('/{skill?}', 'DoctorController@commonList')->name('list');
});
Route::get('medcenters', 'MedcenterController@list')->name('all.medcenters.list');

Route::get('agreement', function (){
    return view('redesign.agreement');
})->name('agreement');

//Route::get('doctors/{city?}/{skill?}', function (\App\City $city, \App\Skill $skill = null) {
//    return redirect()->route('doctors.list', ['skill' => $skill->alias ?? null]);
//});
//Route::get('medcenters/{city?}', function (\App\City $city = null) {
//    return redirect()->route('medcenters.list');
//});

Route::get('medcenter/{medcenter}', function (\App\Medcenter $medcenter) {
    return redirect()->route('medcenter.item', ['medcenter' => $medcenter->alias]);
});

Route::group(['prefix' => '{city}'], function () {
    Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function () { //Добавил z - удалить
        Route::get('/{input?}/{modifier?}', 'DoctorController@list')->name('list');
    });
    Route::group(['prefix' => 'doctors_old', 'as' => 'doctors_old.'], function () { //Добавил z - удалить
        Route::get('/{skill?}', 'DoctorController@listOld')->name('list');
    });
    Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
        Route::get('/{doctor}', 'DoctorController@item')->name('item');
        Route::get('/{doctor}/feedback', 'DoctorController@feedback')->name('feedback');
        Route::get('/{doctor}/mass-feedback', 'DoctorController@massFeedback')->name('mass-feedback');
    });
    Route::group(['prefix' => 'doctor_old', 'as' => 'doctor_old.'], function () {
        Route::get('/{doctor}', 'DoctorController@itemOld')->name('item_old');
        Route::get('/{doctor}/feedback', 'DoctorController@feedback')->name('feedback_old');
        Route::get('/{doctor}/comments', 'DoctorController@loadComments')->name('comments_old');
    });
    Route::group(['prefix' => 'medcenters', 'as' => 'medcenters.'], function () {
        Route::get('/', 'MedcenterController@list')->name('list');
    });
    Route::group(['prefix' => 'medcenter', 'as' => 'medcenter.'], function () {
        Route::get('/{medcenter}', 'MedcenterController@item')->name('item');
        Route::get('/{medcenter}/doctors', 'MedcenterController@loadDoctors')->name('doctors');
        Route::get('/{medcenter}/feedback', 'MedcenterController@feedback')->name('feedback');
    });

});

Route::get('/{modelName}/{id}/comments', 'CommentController@loadComments')->name('load-comments');


Route::group(['prefix' => 'library', 'as' => 'library.'], function () {
    Route::get('/', 'LibraryController@index')->name('index');
    Route::get('/{illnesses_group}', 'LibraryController@groupArticles')->name('illnesses-group-articles');
    Route::get('/{illnesses_group}/{article}', 'LibraryController@article')->name('illnesses-group-article');
});
Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
    Route::get('/', 'ServiceController@index')->name('index');
   // Route::get('/seed', 'ServiceController@seed')->name('seed');
    Route::get('/{alias}', 'ServiceController@groupList')->name('group');
    Route::get('/{group}/{alias}', 'ServiceController@medcentersList')->name('medcenter-list');
});

Route::group(['prefix' => 'illnesses', 'as' => 'illnesses.'], function () {
    Route::get('/{letter?}', 'LibraryController@illnesses')->name('index');
});
Route::get('illness/{illness}', 'LibraryController@illness')->name('illness');

//Drugs **********************************************
Route::get('drugs/', 'DrugsController@list');
Route::get('drug/{id}', 'DrugsController@item');
//callback **********************************************
Route::get('callback/new/', 'CallbackController@newQuick');
Route::get('callback/newDoc/', 'CallbackController@newDoc')->name('callback.newDoc');
Route::get('callback/oldDoc/', 'CallbackController@oldDoc')->name('callback.oldDoc');
//***comments

Route::get('comment/new', 'CommentController@new');
Route::post('comment/requestCode', 'CommentController@requestPhoneCode');
Route::post('comment/confirm-code', 'CommentController@confirmPhone');
Route::get('comment/{id}/rate/{rate}', 'CommentController@rateComment')->name('rateComment');


//******questions*****************

Route::post('question/add', 'QuestionController@add');
Route::get('question/item/{question}', 'QuestionController@item');
Route::get('question/list', 'QuestionController@listQuestions')->name('question.list');
Route::get('question/landing', function () {
    return view('questions.landing');
});


//******Posts***************************
Route::get('post/{alias}', 'PostController@item')->name('post');
Route::get('posts', 'PostController@list')->name('posts');
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

Route::get('setcity/{cityid}', 'BaseController@setcity')->name('setcity');

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
Route::get('/ajax/autocomplete','SearchController@autocomplete');

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

Route::group(['as' => 'cabinet.', 'prefix' => 'cabinet', 'middleware' => ['auth','doctor']], function () {
    Route::group(['as' => 'doctor.', 'prefix' => 'doctor'], function () {

        Route::view('/feedback/index','cabinet.doctor.feedback.index')->name('feedback.index');



        Route::group(['as' => 'personal.', 'prefix' => 'personal'], function () {
            Route::get('/index', 'Cabinet\Doctor\DoctorCabinetPersonalController@index')->name('index');
            Route::get('/edit', 'Cabinet\Doctor\DoctorCabinetPersonalController@edit')->name('edit');
            Route::post('/edit', 'Cabinet\Doctor\DoctorCabinetPersonalController@update')->name('update');
            Route::post('/photo-upload', 'Cabinet\Doctor\DoctorCabinetPersonalController@photoUpload')->name('photo-upload');
        });
        Route::group(['as' => 'professional.', 'prefix' => 'professional'], function () {
            Route::get('/index', 'Cabinet\Doctor\DoctorCabinetProfessionalController@index')->name('index');
            Route::get('/edit', 'Cabinet\Doctor\DoctorCabinetProfessionalController@edit')->name('edit');
            Route::post('/edit', 'Cabinet\Doctor\DoctorCabinetProfessionalController@update')->name('update');
        });
        Route::group(['as' => 'questions.', 'prefix' => 'questions'], function () {
            Route::get('/index', 'Cabinet\Doctor\DoctorCabinetQuestionsController@index')->name('index');
            Route::get('/view/{question}', 'Cabinet\Doctor\DoctorCabinetQuestionsController@viewQuestion')->name('view');
            Route::post('/view/{question}', 'Cabinet\Doctor\DoctorCabinetQuestionsController@sendAnswer')->name('view');
            Route::get('/view/{id}/edit', 'Cabinet\Doctor\DoctorCabinetQuestionsController@editAnswer')->name('edit');
            Route::post('/view/{id}/edit', 'Cabinet\Doctor\DoctorCabinetQuestionsController@updateAnswer')->name('update');
        });

        Route::get('/', function (){
        });
        Route::post('/orderList', 'Cabinet\Doctor\DoctorCabinetController@orderList')->name('orderList');
        Route::get('/orderDetails/{id?}', 'Cabinet\Doctor\DoctorCabinetController@orderDetails')->name('orderDetails');
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

Route::get('/load', 'ExcelController@loadDoctors')->name('load.doctors');
Route::get('/load-skills', 'ExcelController@loadSkills')->name('load.skills');
Route::get('/add-phones', 'ExcelController@addPhones')->name('load.phones');

Route::get('/clients-sms', 'SmsController@sendToClients')->name('sms.clients');

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

