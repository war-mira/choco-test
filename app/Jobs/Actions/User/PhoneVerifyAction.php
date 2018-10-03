<?php

namespace App\Jobs\Actions\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PhoneVerifyAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subject, $payload)
    {
        $this->user = $subject;
        $this->phone = $payload['phone'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->phone = $this->phone;
        $this->user->phone_verified = true;
        $this->user->save();
    }
}
