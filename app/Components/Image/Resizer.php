<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.09.2018
 * Time: 11:37
 */

namespace App\Components\Image;


trait Resizer
{
    public function getImageUrl($url,$width,$height,$quality = 85){

        if (substr($url, 0, 1) !== '/') {
            $url = '/'.$url;
        }
        return (new ImageResize($quality))->getImage($url,$width,$height);
    }

}