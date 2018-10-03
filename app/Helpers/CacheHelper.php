<?php


namespace App\Helpers;


use Illuminate\Support\Str;

class CacheHelper{

    public static function getKeyFromUrl()
    {
        $url = parse_url(url()->full());
        $path = str_replace("/", "-", $url['path']??'');

        $query = str_replace("=", "_", urldecode($url['query']??''));

        $query = Str::ascii(urldecode(str_replace("&", "--", $query)));
        return $path.'__'.$query;
    }
}