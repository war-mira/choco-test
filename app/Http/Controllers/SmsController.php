<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use function morphos\Russian\inflectName;

class SmsController extends Controller
{
    public function sendToClients()
    {
        $orders = Order::where('status', 2)
            ->whereNotNull('phone')
            ->orderBy('updated_at', 'desc')
            ->take(500)->get();

        foreach ($orders as $order) {
            if ($order->doctor) {
                $clientName = $order->client_name ? $order->client_name : 'пациент';
                $phone = $order->phone;
                $doctorName = $order->doctor ? $order->doctor->firstname . ' ' . $order->doctor->lastname : '';
                $doctorName = inflectName($doctorName, 'винительный');
                $text = 'Уважаемый (ая) ' . $clientName . ', Вы посещали врача '.$doctorName.'. Все ли Вам понравилось? По ссылке ниже Вы можете оценить работу врача и оставить отзыв о нем. Нам важно знать, насколько качественно врач помог решить вашу проблему.' .route('doctor.mass-feedback', ['doctor' => $order->doctor->alias, 'utm_source' => 'site', 'utm_medium' => 'sms', 'utm_campaign' => 'review']).'
                Желаем Вам здоровья!
                с Уважением,
                команда iDoctor.kz';

                \SmsService::send([
                    'recipient' => $phone,
                    'text'      => $text
                ]);

            }
        }

        return 'ok';
    }
}
