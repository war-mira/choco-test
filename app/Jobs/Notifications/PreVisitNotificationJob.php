<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 14:12
 */

namespace App\Jobs\Notifications;

use App\Facades\SmsService;
use App\Helpers\FormatHelper;
use App\Order;
use App\SmsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PreVisitNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notification;

    public function __construct($order)
    {
        $smsNotification = SmsNotification::query()->create([
            'order_id'  => $order->id,
            'type'      => SmsNotification::TYPE_PRE,
            'recipient' => FormatHelper::phone($order['client_info']['phone']),
            'text'      => $this->getNotificationText($order)
        ]);
        $this->notification = $smsNotification;
    }

    private function getNotificationText(Order $order)
    {
        $order->load('medcenter');
        $eventDate = $order->event_date;
        $shortTime = $eventDate->format('H:i');
        $medcenterAddress = empty($order->medcenter->sms_address) ? ($order->medcenter->map ?? false) : $order->medcenter->sms_address;
        $medcenterName = $order->medcenter->name ?? '-';
        if ($shortTime && $medcenterAddress) {
            $text = "Уважаемый пациент! Напоминаем о приеме к врачу сегодня в "
                . $shortTime . " по адресу " . $medcenterAddress . " «" . $medcenterName . "».";
        } else {
            $text = false;
        }
        return $text;
    }

    public function handle()
    {
        $status = SmsService::send($this->notification);
        $this->notification->update(['status' => $status]);
    }

}