<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.09.2018
 * Time: 11:12
 */

namespace App\Components\Image;



use App\Components\Image\Compressor\ImageCompressor;
use Illuminate\Support\Str;
use Intervention\Image\Image;

class ImageResize
{
    //TODO: Refactor
    /**
     * @param $src
     * @param $width
     * @param $height
     * @return mixed|string
     */
    public $quality = 85;
    public function __construct($quality = 85)
    {
        $this->quality = $quality;
    }
    public function getImage($src,$width,$height)
    {
        $path =  pathinfo($src);
        if($this->isImageExist($src,$width,$height)){
            return $this->getImageLink($path,$width,$height);
        } else{
            $extension = Str::lower($path['extension']);
            if($extension == 'jpg'){
                return $this->createImageWith($src,$width,$height);
            }
            return $src;
        }
    }

    public function getImageLink($path,$width,$height)
    {
        $compressor = new ImageCompressor();
        $filename = self::getRootDir().$path['dirname'].'/'.$this->getFilenameWithSize($path['filename'],$width,$height).'.'.$path['extension'];
        if($compressor->optimizedExist($filename,$this->quality)){
            return $compressor->getOptimized($path['dirname'],$filename,$this->quality);
        } else{
            try{
                $compressor->compress($filename,$this->quality );
            } catch (\Exception $e){}
            return  $path['dirname'].'/'.$this->getFilenameWithSize($path['filename'],$width,$height).'.'.$path['extension'];
        }
    }


    /**
     * @param $width
     * @param $height
     * @return mixed|string
     */
    public function createImageWith($src,$width,$height)
    {
        $path = pathinfo($src);
        $filepath = self::getRootDir().'/'.$path['dirname'].'/'.$path['basename'];
        $new_path = $this->getImageLink($path,$width,$height);
        if(!file_exists($filepath)){
            return $src;
        }
        $img = \Image::make($filepath);
        if($width == 'auto'){
            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if($height == 'auto'){
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else{
            $img->fit($width,$height);
        }
        $img->save(self::getRootDir().$new_path);

        return $new_path;
    }
    public function isImageExist($src,$width,$height)
    {
        $directory =  self::getRootDir();
        $path = pathinfo($src);
        $filename = $this->getFilenameWithSize($path['filename'],$width,$height);
        return file_exists($directory.$path['dirname'].'/'.$filename.'.'.$path['extension']);
    }
    public function getFilenameWithSize($filename,$width,$height)
    {
        return $filename.'_'.$width.'x'.$height;
    }

    public static function getRootDir()
    {
        return public_path();
    }

}