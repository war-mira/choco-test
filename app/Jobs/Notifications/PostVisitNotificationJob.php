<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 14:13
 */

namespace App\Jobs\Notifications;

use App\Helpers\FormatHelper;
use App\Order;
use App\SmsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SmsService;

class PostVisitNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private function getNotificationText(Order $order)
    {
        $postOrderFeedbackUrl = route('doctors.profile', ['alias' => $order->doc_id]) . "#comments";
        if ($postOrderFeedbackUrl) {
            $text = "Помог ли Вам доктор? Оставляйте отзывы о враче по ссылке " . $postOrderFeedbackUrl . " Будьте здоровы!";
        } else {
            $text = false;
        }
        return $text;
    }

    private $notification;

    public function __construct($order)
    {
        $smsNotification = SmsNotification::query()->create([
            'order_id' => $order->id,
            'type' => SmsNotification::TYPE_POST,
            'recipient' => FormatHelper::phone($order['client_info']['phone']),
            'text' => $this->getNotificationText($order)
        ]);
        $this->notification = $smsNotification;
    }

    public function handle()
    {
        $status = SmsService::send($this->notification);
        $this->notification->update(['status' => $status]);
    }
}