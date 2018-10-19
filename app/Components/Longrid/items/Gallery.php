<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\items;


class Gallery extends BaseItem
{
    public $min_height;
    public function inspectSelf()
    {
        $this->setMinHeight();
        $container = $this->getColumnContainer();
        $container->type = 'full';

        $this->getRow()->parent()->setUsedTag('carousel');
    }


    public function setMinHeight(){
        $min_height = 500;
        foreach ($this->items as $item){
            $filepath = ImageResize::getRootDir().'/'.$item->image;
            $height = getimagesize($filepath)[1];
            if($min_height == 500){
                $min_height = $height;
            } else{
                if($height < $min_height){
                    $min_height = $height;
                }
            }
        }
        $this->min_height = $min_height;
    }

    public function getMinHeight()
    {
        if(is_null($this->min_height)){
            $this->setMinHeight();
        }
        if($this->min_height > 1200){
            return 1200;
        }
        return $this->min_height;
    }

    public function getOriginalSizes($filepath)
    {
        $filepath = ImageResize::getRootDir().'/'.$filepath;
        list($width,$height,$type1, $attr1) = getimagesize($filepath);

        return [ $width, $height ];
    }

    public function getSizesForPhotoSwipe($filepath)
    {
        list($width,$height) = $this->getOriginalSizes($filepath);
        return $width.'x'.$height;
    }
}