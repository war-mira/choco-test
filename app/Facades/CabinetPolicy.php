<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.10.2017
 * Time: 15:38
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class CabinetPolicy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cabinetPolicyService';
    }

}