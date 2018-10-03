<?php

namespace App\Jobs;

use App\Enums\Order\NotifyType;
use App\Enums\OrderStatus;
use App\Enums\SmsNotification\ConfirmStatus;
use App\Enums\SmsNotification\SendStatus;
use App\SmsNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SmsNotificationsJob implements ShouldQueue
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
        $yestarday = Carbon::yesterday()->startOfDay();
        $now = Carbon::now();
        $notificationsToSend = SmsNotification::query()
            ->whereBetween('send_at', [$yestarday, $now])
            ->where('confirm_status', ConfirmStatus::CONFIRM)
            ->where('send_status', SendStatus::NONE)
            ->whereHas('order', function (Builder $orderQuery) {
                $orderQuery
                    ->whereIn('send_notify', [NotifyType::SMS_EMAIL, NotifyType::SMS])
                    ->where('status', OrderStatus::VISIT_CHECK);
            })
            ->get();
        $notificationsToSend->each(
            function (SmsNotification $notification) {
                \NotificationService::sendOrderNotification($notification);
            });
    }
}
