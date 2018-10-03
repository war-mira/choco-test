<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Redis;

class RoutePathfinder
{

    static $prefix = 'routes:redirects:';


    public static function set($from, $to, $code = 301, $away = false)
    {
        return Redis::set(self::$prefix.$from, json_encode(compact('to','code','away')));
    }


    public static function get($from)
    {
        return json_decode(Redis::get(self::$prefix.$from));
    }

    // TODO: remove or just rewrite old one

    public static function getList($pattern = '*')
    {
        return collect(Redis::keys(static::$prefix.$pattern))->transform(function ($key){
           return collect(['from'=> substr($key,strlen(static::$prefix))])->merge(json_decode(Redis::get($key)));
        });
    }
}