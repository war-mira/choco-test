<?php

namespace App\Http\Middleware;

use Closure;

class Http2Push
{
    public $assets = [];
    public static  $custom = [];
    public function __construct()
    {
        $this->assets = [
            "<".mix('/build/css/app.css').">; rel=preload; as=style",
        ];
    }
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        $links = array_merge($this->assets,self::$custom);

        $response->headers->add([
            'Link'=>implode(',',$links)
        ]);
        return $response;
    }

    public static function addJs($link){
        try{
            $link = mix($link);
        } catch (\Exception $e){}
        $link ="<".$link.">; rel=preload; as=script";


        array_push(self::$custom,$link);
    }
    public static function addCss($link){
        try{
            $link = mix($link);
        } catch (\Exception $e){}
        $link =  "<".$link.">; rel=preload; as=style";
        array_push(self::$custom,$link);
    }
}
