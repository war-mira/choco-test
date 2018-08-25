<?php

namespace App\Console;

use App\Jobs\GaEcommerceJob;
use App\Jobs\SendDoctorReviewWeeklyDigest;
use App\Jobs\SmsNotificationsJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            (new SmsNotificationsJob())->handle();
        })->everyMinute();

        $schedule->call(function () {
            (new GaEcommerceJob())->handle();
        })->everyMinute();

        $schedule->job(new SendDoctorReviewWeeklyDigest)->fridays()->at('10:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
