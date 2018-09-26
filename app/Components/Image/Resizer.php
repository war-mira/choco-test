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
    public function getImageUrl($src, $width, $height, $quality = 85)
    {

        if (substr($src, 0, 1) !== '/') {
            $src = '/' . $src;
        }
        return (new ImageResize($src, $quality))
            ->setRootDir(public_path())
            ->getImage($width, $height);
    }

}