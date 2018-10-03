<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.12.2017
 * Time: 1:08
 */

namespace App\Services;


use App\Helpers\FormatHelper;
use App\Interfaces\IMessageService;
use App\Model\SmsRecord;

class EmailService implements IMessageService
{
    const DEV_EMAIL = 'nadilk@ya.ru';

    public function __construct()
    {
    }

    public function send($message)
    {
        $recipient = FormatHelper::phone($message['recipient']);
        $text = $message['text'];

        $sms = SmsRecord::query()->create([
            'service'   => 'dev-email',
            'login'     => 'dev-email',
            'recipient' => $recipient,
            'text'      => $text
        ]);


        try {
            \Mail::raw($sms->toJson(JSON_UNESCAPED_UNICODE), function ($message) {
                $message->to(self::DEV_EMAIL);
            });
            $sms->update(['status' => 1]);
        } catch (\Exception $e) {
            $sms->update(['status' => -1]);
        }
        return $sms;
    }

    public function getStatus($messageId)
    {
        // TODO: Implement getStatus() method.
    }
}