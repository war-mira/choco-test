<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.09.2017
 * Time: 17:52
 */

namespace App\Interfaces;


interface IReferenceable
{
    public function updateCommentRate();

    public function getHrefAttribute();

    public function getNameAttribute();

    public function getTypeAttribute();
}