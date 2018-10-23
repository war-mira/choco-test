<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\Items;


class Text extends BaseItem
{
    public function inspectSelf()
    {
        $this->content = $this->setBanners($this->content);
    }
}