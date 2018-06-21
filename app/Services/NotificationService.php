<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.10.2017
 * Time: 11:41
 */

namespace App\Services;


use App\Enums\SmsNotification\NotificationType;
use App\Enums\SmsNotification\SendStatus;
use App\Helpers\FormatHelper;
use App\Jobs\Notifications\NewOrderNotificationJob;
use App\Jobs\Notifications\PostVisitNotificationJob;
use App\Jobs\Notifications\PreVisitNotificationJob;
use App\Order;
use App\SmsNotification;
use Carbon\Carbon;

class NotificationService
{
    private $config = null;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function sendOrderNotification(SmsNotification $notification)
    {
        $sms = \SmsService::send($notification);
        if ($sms['status'] == 1) {
            $notification->update([
                'send_status'  => SendStatus::SENT,
                'delivered_at' => now()
            ]);
        } else {
            $notification->update(['send_status' => SendStatus::ERROR]);
        }
        return $sms;
    }

    public function syncOrderNotification(SmsNotification $notification)
    {
        if ($notification->send_status == SendStatus::NONE) {
            switch ($notification['type']) {
                case NotificationType::NEW:
                    $sendAt = now();
                    $text = $this->getNewNotificationText($notification->order);
                    break;
                case NotificationType::PRE:
                    $sendAt = $notification->order->pre_notification_date;
                    $text = $this->getPreNotificationText($notification->order);
                    break;
                case NotificationType::POST:
                    $sendAt = now();
                    $text = $this->getPostNotificationText($notification->order);
                    break;
            }
            $notification->update([
                'recipient' => FormatHelper::phone($notification->order['client_info']['phone']),
                'text'      => $text,
                'send_at'   => $sendAt
            ]);
        }

        return $notification;
    }

    private function getNewNotificationText(Order $order)
    {
        $order->load('medcenter');


        if (isset($order->event_date) && isset($order->medcenter)) {
            $eventDate = $order->event_date;
            $shortDate = $eventDate->format("d.m.Y");
            $shortTime = $eventDate->format("H:i");
            $medcenterAddress = empty($order->medcenter->sms_address) ? ($order->medcenter->map ?? false) : $order->medcenter->sms_address;
            $medcenterName = $order->medcenter->name ?? '-';
            $text = "Благодарим Вас за обращение в iDoctor.kz! " .
                "Ваш визит состоится " . $shortDate . " в " . $shortTime .
                " по адресу: " . $medcenterAddress . " " .
                "«" . $medcenterName . "». Выздоравливайте!";
        } else {
            $text = false;
        }
        return $text;
    }

    private function getPreNotificationText(Order $order)
    {
        $order->load('medcenter');
        if (isset($order->event_date) && isset($order->medcenter)) {
            $eventDate = $order->event_date;
            $shortTime = $eventDate->format('H:i');
            $medcenterAddress = empty($order->medcenter->sms_address) ? ($order->medcenter->map ?? false) : $order->medcenter->sms_address;
            $medcenterName = $order->medcenter->name ?? '-';
            $text = "Уважаемый пациент! Напоминаем о приеме к врачу сегодня в "
                . $shortTime . " по адресу " . $medcenterAddress . " «" . $medcenterName . "».";
        } else {
            $text = false;
        }
        return $text;
    }

    private function getPostNotificationText(Order $order)
    {
        if (isset($order->doctor)) {
            $postOrderFeedbackUrl = $order->doctor->href . "#comments";
            $text = "Помог ли Вам доктор? Оставляйте отзывы о враче по ссылке " . $postOrderFeedbackUrl . " Будьте здоровы!";
        } else {
            $text = false;
        }
        return $text;
    }

    public function createOrderNotification(Order $order, $type, $confirm = false)
    {
        switch ($type) {
            case NotificationType::NEW:
                $sendAt = now();
                $text = $this->getNewNotificationText($order);
                break;
            case NotificationType::PRE:
                $sendAt = $order->pre_notification_date;
                $text = $this->getPreNotificationText($order);
                break;
            case NotificationType::POST:
                $sendAt = now();
                $text = $this->getPostNotificationText($order);
                break;
        }
        $smsNotification = SmsNotification::query()->create([
            'order_id'       => $order->id,
            'type'           => $type,
            'recipient'      => FormatHelper::phone($order['client_info']['phone']),
            'text'           => $text,
            'send_at'        => $sendAt,
            'confirm_status' => $confirm
        ]);

        return $smsNotification;
    }

    public function newOrderNotify(Order $order)
    {
        $isCheck = $order->status == 1;
        $sendSms = $order->send_notify == 1 || $order->send_notify == 2;

        $hasNewNotifications = $order->smsNotifications()->type(SmsNotification::TYPE_NEW)->count() > 0;

        if (!$hasNewNotifications && $isCheck && $sendSms && $order->event_date > now())
            (new NewOrderNotificationJob($order))->handle();
    }

    public function preOrderNotify(Order $order)
    {
        $isCheck = $order->status == 1;
        $sendSms = $order->send_notify == 1 || $order->send_notify == 2;

        $hasPreNotifications = $order->smsNotifications()->type(SmsNotification::TYPE_PRE)->count() > 0;

        if (isset($order->event_date)) {
            $eventDate = Carbon::createFromFormat('Y-m-d H:i:s', $order->event_date)->timestamp;
            $secondsLeft = $eventDate - now()->timestamp;
            $isNotifyTime = ($secondsLeft > 0 && $secondsLeft <= $order->notify_before && $sendSms);

            if (!$hasPreNotifications && $isCheck && $isNotifyTime)
                (new PreVisitNotificationJob($order))->handle();
        }
    }

    public function postOrderNotify(Order $order)
    {
        $isCheck = $order->status == 1 || $order->status == 2;
        $sendSms = $order->send_notify == 1 || $order->send_notify == 2;

        $hasPostNotifications = $order->smsNotifications()->type(SmsNotification::TYPE_POST)->count() > 0;

        if (isset($order->event_date)) {
            $eventDate = $order->event_date;
            $hasVisited = $eventDate < now();
            $isEvening = now()->hour >= 18 && now()->hour <= 21;
            $isNotifyTime = ($hasVisited && $sendSms && $isEvening);

            if (!$hasPostNotifications && $isCheck && $isNotifyTime)
                (new PostVisitNotificationJob($order))->handle();
        }
    }

}