<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.02.2018
 * Time: 16:43
 */

namespace App\Interfaces;


interface SmsSendable
{
    public function getSmsRecipient();

    public function getSmsText();
}