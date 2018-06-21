<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.12.2017
 * Time: 1:06
 */

namespace App\Interfaces;


interface IMessageService
{
    public function send($message);

    public function getStatus($messageId);
}