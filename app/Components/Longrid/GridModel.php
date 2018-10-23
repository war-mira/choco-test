<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.10.2018
 * Time: 16:24
 */

namespace App\Components\Longrid;


trait GridModel
{

    public function getJsonContentAttribute()
    {
        return json_decode($this->content);
    }
}