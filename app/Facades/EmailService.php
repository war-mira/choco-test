<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 23:02
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class EmailService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emailService';
    }
}