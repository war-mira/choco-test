<?php

namespace App\Jobs\Auth;

use App\Facades\SmsService;
use App\Model\Auth\PhoneVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PhoneSmsVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $pendingVerifications;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pendingVerifications = PhoneVerification::query()
            ->where('status', 0)
            ->get();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->pendingVerifications as $verification) {
            $message = [
                'text' => 'iDoctor.kz код подтверждения: ' . $verification->verify_code,
                'recipient' => $verification->phone];
            if (SmsService::send($message))
                $verification->update(['status' => 1]);
        }
    }
}
