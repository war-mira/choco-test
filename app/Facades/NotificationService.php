<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.10.2017
 * Time: 12:56
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class NotificationService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'notificationService';
    }
}