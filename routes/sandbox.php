<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.11.2017
 * Time: 15:24
 */

use App\Doctor;
use App\Skill;
use Illuminate\Support\Facades\Redis;

Route::group(['middleware' => 'role:superdev', 'as' => 'sandbox.', 'prefix' => 'sandbox'], function () {
    Route::get('/test', function () {
        return response('ok');
    })->name('test');
    Route::get('enumImages', 'Sandbox\ImageStorageController@enumImages');
    Route::get('checkBindings', 'Sandbox\ImageStorageController@checkBindings');
    Route::post('removeImages', 'Sandbox\ImageStorageController@removeImages')->name('removeImages');
    Route::get('/testSms', 'Sandbox\SmsServiceTestController@testSend');
    Route::get('/testPhoneVerify', 'Auth\PhoneVerificationController@requestCode');
    Route::get('/reacalcDoctorsRate', 'Sandbox\DoctorRateController@recalcRate');
    Route::get('/clientsReport', 'Sandbox\OrdersReportController@clientsReport');
    Route::get('/migrateMedcenterAvatar', 'Sandbox\MedcenterAvatarMigrationController@migrateAvatars');

    Route::get('/migrateOrdersTimestamps', 'Sandbox\OrdersMigrationController@migrateTimestamps');

    Route::get('/migratePostCoverImages', 'Sandbox\PostsCoverMigrationController@migrateCovers');
    Route::get('/migratePostTimestamps', 'Sandbox\PostsTimestampsMigrationController@migrateTimestamps');
    Route::get('/seedDoctorStatuses', 'Sandbox\StatusesSeedController@seedDoctorStatuses');

    Route::get('/migrateCommentsTimestamps', 'Sandbox\CommentsTimestampsMigrationController@migrateTimestamps');

    Route::get('/lostClients18', 'Sandbox\OrdersReportController@lostClients');

    Route::get('/migrateRating', 'Sandbox\RatingMigrationController@migrateRating');

    Route::get('/fixPhones', 'Sandbox\PhoneFormatFixController@fixPhones');

    Route::get('/components/pair-select', function () {
        $data1 = \App\Doctor::query()->where('status', 1)->orderBy('lastname')->get()->mapWithKeys(function ($doctor) {
            return [
                $doctor->id => [
                    'title' => $doctor->name,
                    'bind' => $doctor->medcenters()->pluck('medcenters.id')
                ]
            ];
        });
        $data2 = \App\Medcenter::query()->orderBy('name')->get()->mapWithKeys(function ($medcenter) {
            return [
                $medcenter->id => [
                    'title' => $medcenter->name,
                    'bind' => $medcenter->doctors()->pluck('doctors.id')
                ]
            ];
        });

        $id = 'composgpto';
        return view('test.pair-select', compact('id', 'data1', 'data2'));
    });
    Route::get('memcacheView', function () {
        return view('test.memcache');
    });

    Route::get('memcache', function (\Illuminate\Http\Request $request) {
        $lastUpdate = $request->query('t', 0);
        $value = \Illuminate\Support\Facades\Cache::get('memtest');

        if ($lastUpdate < $value['t'])
            return response($value, 200);
        else
            return response('', 304);
    });

    Route::post('memcache', function (\Illuminate\Http\Request $request) {
        $value = $request->input('value');
        $t = now()->timestamp;
        \Illuminate\Support\Facades\Cache::put('memtest', compact('value', 't'), 10);
        return $value;
    });


    Route::get('comment-digest',function (){
        $digest = \App\Comment::where([
                'status'=>1,
                'owner_type'=>'Doctor',
                ['created_at','>',\Carbon\Carbon::now()->startOfWeek()->toDateTimeString()]
            ])
            ->get()
            ->groupBy('owner_id')
            ->transform(function ($item,$key){

                $doc = Doctor::find($key);

                $name = $doc->firstname . ' ' . $doc->lastname;
                $mail = $doc->user ? $doc->user->email : $doc->email;

                $mail = 'alex@fed.kz';

                if(str_is('*@*.*',$mail))
                    Mail::to($mail)->send(new \App\Mail\DoctorReviewsWeeklyMail($name, $item));

                return  [
                    'mail'=>$mail,
                    'name'=>$name,
                    'items'=>$item->toArray()
                ];
            })
        ;

//        Doctor::whereHas('comments',function ($q){
//            return $q->where(['status'=>1])->whereDate('created_at','>',\Carbon\Carbon::now()->startOfWeek());
//        });

        dd( \Carbon\Carbon::now()->startOfWeek()->toDateTimeString(), $digest );
    });




    Route::get('search-index',function (){

        $index_set = Doctor::public();
        $per_page = 50;
        $total_pages = $index_set->count()/$per_page;

        $config = [
            'model' => class_basename(Doctor::class),
            'fields'=> [
                'name',
                'firstname',
                'lastname',
                'patronymic',
                'skills'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'illnesses'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'qualifications'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'medcenters'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'additional'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'city'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[
                        'Алматы'=>[
                            'Алма-Ата',
                            'Культурная столица'
                        ]
                    ]
                ],
            ]
        ];

        Redis::publish('search indexing pages',$total_pages);
        Redis::publish('search indexing',$index_set->count());

        for($page=0; $page<=$total_pages; $page++){

            $data = $index_set->skip($per_page*$page)->take($per_page)->get();
            \App\Jobs\SearchIndexJob::dispatch($config,$data);
        }

        dd(
            $total_pages,
            $index_set->count()
        );
    });




    Route::any('search/{input?}/{modifier?}',function (\App\Http\Requests\Doctor\DoctorFilters $filters, $input = '', $modifier = ''){


        $search = new \App\Helpers\DoctorSearcher([$input,$modifier]);

        $search->lex()->context()->registerLog();

        $filter = $search->filter->toArray();
        $log = $search->log;
        $undefined = $search->stack;
        $processed = $search->input;


        $dump = [
            'unknown requests'=> Redis::zrangebyscore('documentSearcher:unrecoqnizedRequest','-inf','+inf','WITHSCORES'),
            'unrecognized'=> collect(Redis::keys('documentSearcher:unrecoqnized:*'))
                ->transform(function ($item){
                   return [substr($item,30) => collect(Redis::smembers($item))
                       ->transform(function ($record){
                            return json_decode($record);
                        })];
                })
        ];



        $docs = \App\Doctor::filter($filters->add($filter))->count();

        return (
            [
                'original'=>[
                    $input,
                    $modifier,
                    $filters
                ],
                'processing'=>$processed,
                'not recognized'=>$undefined,
                'filter'=>$filter,
                'log'=>$log,
                'result'=>$docs,
                'dump'=>$dump
            ]
        );
    });

    Route::view('sessions','sandbox.sessions');


    Route::get('convert-blog',function (){

        $ar = [];
//        return '';
        foreach ($ar as $id=>$group){
            $post = \App\Post::find($id);
            if(\App\Models\Library\IllnessesGroupArticle::create([
                'name'=>$post->title,
                'illnesses_group_id'=>$group,
                'description' => $post->content,
                'description-lite' => $post->content_lite,
                'alias' => $post->alias,
                'meta_title' => $post->meta_title??'',
                'meta_key' => $post->meta_key??'',
                'meta_desc' => $post->meta_desc??'',
                'image' => $post->cover_image
            ]))
                $post->update(['status'=>0]);
        }

        return '';

    });



    Route::get('routes',function(){
        return view('sandbox.redirects');
    });
    Route::get('routes/list',function(){

        return [
            'route'=> request()->path(),
            'list'=>\App\Helpers\RoutePathfinder::getList()
        ];
    });

    Route::post('routes',function(){
        return \App\Helpers\RoutePathfinder::set(
            request('from'),
            request('to')
        );
    });
});
