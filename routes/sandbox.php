<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.11.2017
 * Time: 15:24
 */
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

});