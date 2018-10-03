<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('run-telegram-bot', function () {

});

Artisan::command('slug:doctors', function () {
    \App\Doctor::all()->each(function (\App\Doctor $doctor) {
        $transName = \Slug::make($doctor->name);
        $doctor->alias = $doctor->id . "-" . $transName;
        $doctor->save();
    });
});

Artisan::command('slug:medcenters', function () {
    \App\Medcenter::all()->each(function (\App\Medcenter $medcenter) {
        $transName = \Slug::make($medcenter->name);
        $medcenter->alias = $medcenter->id . "-" . $transName;
        $medcenter->save();
    });
});