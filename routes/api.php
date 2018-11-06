<?php

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['auth'])->group(function () {

    Route::get('/me',function(Request $request){
        $user = Auth::user();
        return (new \App\Http\Resources\UserResource($user));
    });
    Route::post('/user/getCode','Api\UserController@requestCode');
    Route::post('/user/checkCode','Api\UserController@checkCode');
    Route::post('/user/update','Api\UserController@update');
    Route::post('/user/updatePassword','Api\UserController@updatePassword');

});
Route::group(['prefix'=>'my'],function (){
    Route::resource('reviews','FeedbackController');
});

Route::group(['prefix'=>'v2'],function (){

    Route::get('{obj}/{id}/votes', 'VoteController@index');
    Route::get('{obj}/{id}/vote', 'VoteController@show');
    Route::post('{obj}/{id}/vote', 'VoteController@store')->middleware('auth');  // TODO: policy
    Route::get('{model}/{id}/clicks-count', 'DoctorController@clicksCount');

    Route::get('{model}/{id}/load-doctors', 'MedcenterController@loadDoctors')->middleware('city');
});

Route::group(['prefix'=>'phones'],function (){

});


Route::get('qr-list',function(){
    $ids = explode(',',request('ids'));

    $docs = Doctor::find($ids);

    $list = $docs->transform(function ($doc){
        return "https://0x.kz/pg/image/cert?f_name={$doc->firstname}&s_name={$doc->lastname}&url={$doc->href}/feedback";
    })->implode("\n");

    return response($list,200,["Content-type"=>"text/plain"]);
});

Route::get('analytics',function (){
    $stat = new \App\Helpers\MetricManager();

    return $stat->report(
        '2018-10-22'
    );
});

Route::get('metrics',function (){
    return [
        'doctors_with_clicks' => count(Redis::keys('doctor:*:show-phone')),
        'doctors_published' => Doctor::public()->count(),
        'medcenters_published' => \App\Medcenter::public()->count(),
        'feedback_opened' => \App\Comment::where(['status'=>1,'owner_type'=>'Doctor'])->count(),
        'feedback_closed' => \App\Comment::where(['status'=>0,'owner_type'=>'Doctor'])->count(),
        'illnesses_opened' => \App\Models\Library\Illness::where('active',1)->count(),
        'illnesses_closed' => \App\Models\Library\Illness::where('active',0)->count(),
        'questions_answered'=> \App\Question::has('answers')->count(),
        'questions_not_answered'=> \App\Question::doesntHave('answers')->count(),
        'visits'=>0,
        'orders'=>\App\Order::whereIn('status',[2,17])->count(),
        'orders_month'=>\App\Order::whereIn('status',[2,17])
            ->whereBetween('created_at',[
                \Carbon\Carbon::now()->startOfMonth(),
                \Carbon\Carbon::now()->endOfMonth()
            ])->count(),
        'orders_month_past'=>\App\Order::whereIn('status',[2,17])
            ->whereBetween('created_at',[
                \Carbon\Carbon::now()->subMonth()->startOfMonth(),
                \Carbon\Carbon::now()->subMonth()->endOfMonth()
            ])->count(),

    ];

});