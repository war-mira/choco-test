<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 15:44
 */

namespace App\Observers;


use App\Enums\SmsNotification\NotificationType;
use App\Enums\SmsNotification\SendStatus;
use App\Facades\NotificationService;
use App\Order;
use App\SmsNotification;

class OrderObserver
{

    public function saved(Order $order)
    {
        $order->smsNotifications()
            ->where('send_status', SendStatus::NONE)
            ->get()->each(function (SmsNotification $notification) {
                $notification->syncWithOrder();
            });
    }

    public function created(Order $order)
    {
        NotificationService::createOrderNotification($order, NotificationType::NEW, true);
        NotificationService::createOrderNotification($order, NotificationType::PRE, true);
        NotificationService::createOrderNotification($order, NotificationType::POST);
    }
}