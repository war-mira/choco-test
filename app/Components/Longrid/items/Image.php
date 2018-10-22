<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\Items;



class Image extends BaseItem
{

    public static $states = [
        'default' => 'Обычная',
        'left' => 'Слева',
        'right' => 'Справа',
        'portrait' => 'Портретная',
        'wide' => 'Широкая',
        'full' => 'На полную',
        'blur' => 'Blurred',
    ];

    public function inspectSelf()
    {
        $container = $this->getColumnContainer();
        if ($this->hasProp('state')) {
            if (in_array($this->state, ['full', 'wide'])) {
                if ($this->state == 'full') {
                    $container->type = 'full';
                } 
                if (!$this->isEmptyCaption()) {
                    $container->additionalRow = true;
                    $data = [
                        'items' => [
                            false, [
                                'type' => 'image__caption',
                                'content' => $this->content
                            ], false, false
                        ]
                    ];
                    $container->additionalRowContent = (new Item())->getHtmlBlock($this->getGridTemplate(), $data);
                }
            }
        }
    }

    public function isEmptyCaption()
    {
        return empty(trim(strip_tags($this->content)));
    }
    public function getOriginalSizes()
    {
        $filepath = ImageResize::getRootDir().'/'.$this->image;
        list($width,$height,$type1, $attr1) = getimagesize($filepath);

        return [ $width, $height ];
    }

    public function getSizes($filename)
    {
        $filepath = ImageResize::getRootDir().'/'.$filename;
        list($width,$height,$type1, $attr1) = getimagesize($filepath);

        return (object)[ 'width'=>$width, 'height'=>$height ];
    }

    public static function getSizesForAmp($filename)
    {
        $filepath = ImageResize::getRootDir().'/'.$filename;
        list($width,$height,$type1, $attr1) = getimagesize($filepath);

        return 'width="'.$width.'" height="'.$height.'"';
    }

    public function getAlt()
    {
        return strip_tags($this->alt);
    }
    public function getDesc()
    {
        return strip_tags($this->desc,'<p><a><i>');
    }
    public function getSizesForPhotoSwipe()
    {
        list($width,$height) = $this->getOriginalSizes();
        return $width.'x'.$height;
    }
}