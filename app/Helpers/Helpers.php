<?php

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
if (! function_exists('hotreload')) {

    function hotreload($path, $manifestDirectory = '')
    {
       try{
           $path =  mix($path, $manifestDirectory = '');
       } catch (Exception $e){
           $path =  version($path);
       }
       return $path;
    }
}

if (! function_exists('version')) {

    function version($path)
    {
        if(file_exists(public_path($path))){
            return new HtmlString($path.'?ver='.filemtime(public_path($path)));
        }
    }
}