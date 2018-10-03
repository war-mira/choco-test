<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.10.2017
 * Time: 10:29
 */

namespace App\Helpers;


use App\City;
use Illuminate\Support\Facades\Session;

class SessionContext
{
    const DEFAULT_CITY_ID = 6;//Almaty

    public static function city()
    {
        $city_id = self::cityId();
        
        return City::find($city_id);
    }

    public static function cityId()
    {
        if (!Session::has('cityid'))
            Session::put('cityid', self::DEFAULT_CITY_ID);
        $city_id = Session::get('cityid', self::DEFAULT_CITY_ID);
        return $city_id;
    }
}