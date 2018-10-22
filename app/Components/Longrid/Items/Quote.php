<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\Items;


class Quote extends BaseItem
{


    public function isEmptyCredits()
    {
        return empty(trim(strip_tags($this->credits)));
    }
}