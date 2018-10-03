<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 23:00
 */

namespace App\Services;


use App\Helpers\FormatHelper;
use App\Model\SmsRecord;
use GuzzleHttp\Client;

class SmsService
{
    const HOST = 'http://service.sms-consult.kz';

    private $config = null;

    public function __construct($config)
    {
        $this->config = $config;
    }

    private function generateSendUrl($smsId, $recipient, $text)
    {
        $url = self::HOST
            . '/get.ashx?'
            . 'login=' . $this->config['login']
            . '&password=' . $this->config['password']
            . '&id=' . $smsId
            . '&type=message'
            . '&recipient=' . $recipient
            . '&sender=' . $this->config['sender']
            . '&text=' . urlencode($text);
        return $url;
    }

    private function generateSendStatusUrl($smsId)
    {
        $url = self::HOST
            . '/get.ashx?'
            . 'login=' . $this->config['login']
            . '&password=' . $this->config['password']
            . '&id=' . $smsId
            . '&type=status';
        return $url;
    }

    public function send($message)
    {
        $recipient = FormatHelper::phone($message['recipient'] ?? $message->getSmsRecipient());
        $text = $message['text'] ?? $message->getSmsText();

        $sms = SmsRecord::query()->create([
            'service' => 'sms-consult',
            'login' => $this->config['login'],
            'recipient' => $recipient,
            'text' => $text
        ]);
        $url = $this->generateSendUrl($sms->id, $recipient, $text);
        $result = $this->getRequest($url);

        if ($result['status'] == 200) {
            $sms->update(['status' => 1]);
        } else {
            $sms->update(['status' => -1]);
        }
        return $sms;
    }

    public function getStatus($messageId)
    {
        $id = (int)$messageId;

        $url = $this->generateSendStatusUrl($id);
        return $this->getRequest($url);
    }

    private function getRequest($url)
    {
        $client = new Client();
        $response = $client->get($url);
        $status = $response->getStatusCode();
        return compact('status');
    }
}