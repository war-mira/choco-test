<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\Items;


class Frame extends BaseItem
{
    public function setUsedTags($tag)
    {
        $this->getRow()->parent()->setUsedTag($tag);
    }
}