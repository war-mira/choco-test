<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2018
 * Time: 13:54
 */

namespace App\Interfaces;


interface Replaceable
{

    public function mergeWithCustomPlaceholders($placeholders);
}