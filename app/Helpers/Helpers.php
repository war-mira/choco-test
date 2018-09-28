<?php

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
if (! function_exists('hotreload')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString
     *
     * @throws \Exception
     */
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
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString
     *
     * @throws \Exception
     */
    function version($path)
    {
        if(file_exists(public_path($path))){
            return new HtmlString($path.'?ver='.filemtime(public_path($path)));
        }
    }
}