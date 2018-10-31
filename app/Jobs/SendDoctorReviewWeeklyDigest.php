<?php

namespace App\Jobs;

use App\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendDoctorReviewWeeklyDigest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $digest = \App\Comment::where([
            'status'=>1,
            'owner_type'=>'Doctor',
            ['created_at','>',\Carbon\Carbon::now()->startOfWeek()->toDateTimeString()]
        ])
            ->get()
            ->groupBy('owner_id')
            ->each(function ($item,$key){

                $doc = Doctor::find($key);

                $name = $doc->firstname . ' ' . $doc->lastname;
                $mail = $doc->user ? $doc->user->email : $doc->email;

//                $mail = 'alex@fed.kz';

                if(str_is('*@*.*',$mail))
                    Mail::to($mail)->send(new \App\Mail\DoctorReviewsWeeklyMail($name, $item));

            })
        ;
    }
}
