<?php

namespace App\Jobs\Notifications;

use App\Facades\NotificationService;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderNotificationJob implements ShouldQueue
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
        $orders = Order::query()
            ->whereDate('event_date', '>=', today()->startOfDay())
            ->whereDate('event_date', '<=', today()->endOfDay())
            ->get();
        foreach ($orders as $order) {
            NotificationService::preOrderNotify($order);
        }

        /*$postOrders = Order::query()
            ->whereDate('event_date', '>=', today()->subDay()->startOfDay())
            ->whereDate('event_date', '<=', today()->endOfDay())
            ->get();

        foreach ($postOrders as $order) {
            NotificationService::postOrderNotify($order);
        }*/

        return;
    }
}
