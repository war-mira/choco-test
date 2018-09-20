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
use Intervention\Image\ImageManager;

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
    public $compress = true;
    private $source;
    private $filename;
    private $basename;
    private $extension;
    private $dirname;
    private $root_dir; // public_path for laravel
    protected $supported_extensions = [
      'jpg','png'
    ];
    public function __construct($source,$quality = 85,$compress = true,$root_dir = null)
    {
        $path = pathinfo($source);
        $this->source = $source;
        $this->extension = $path['extension'];
        $this->filename = $path['filename'];
        $this->basename = $path['basename'];
        $this->dirname = $path['dirname'];
        $this->compress = $compress;
        if(is_null($root_dir)){
            $this->setRootDir($root_dir);
        }
        $this->quality = $quality;
    }
    public function getImage($width,$height)
    {
        if($this->isImageExist($width,$height)){
            return $this->getImageLink($width,$height);
        } else{
            $extension = Str::lower($this->extension);
            if(in_array($extension,$this->supported_extensions)){
                return $this->createImageWith($width,$height);
            }
            return $this->source;
        }
    }

    protected function getImageLink($width,$height)
    {
        if($this->compress){
            $compressor = new ImageCompressor();
            $filename = $this->getFullDirname().'/'.$this->getFilenameWithSize($width,$height).'.'.$this->extension;
            if($compressor->optimizedExist($filename,$this->quality)){
                return $compressor->getOptimized($this->dirname,$filename,$this->quality);
            } else{
                try{
                    $compressor->compress($filename,$this->quality );
                } catch (\Exception $e){}
                return  $this->getResizedLink($width,$height);
            }
        } else{
            return $this->getResizedLink($width, $height);
        }

    }


    /**
     * @param $width
     * @param $height
     * @return mixed|string
     */
    protected function createImageWith($width,$height)
    {

        $filepath = $this->getFullDirname().'/'.$this->basename;
        $new_path = $this->getImageLink($width,$height);
        if(!file_exists($filepath)){
            return $this->source;
        }
        $manager = new ImageManager(['driver' => 'imagick']);
        $image = $manager->make($filepath);
        if($width == 'auto'){
            $image->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if($height == 'auto'){
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else{
            $image->fit($width,$height);
        }
        $image->save($this->getRootDir().$new_path);

        return $new_path;
    }
    private function isImageExist($width,$height)
    {
        $filename = $this->getFilenameWithSize($width,$height);
        return file_exists($this->getFullDirname().'/'.$filename.'.'.$this->extension);
    }

    public function getFullDirname()
    {
        return $this->getRootDir().$this->dirname;
    }
    protected function getFilenameWithSize($width,$height)
    {
        return $this->filename.'_'.$width.'x'.$height;
    }

    public function setRootDir($dir){
        $this->root_dir = $dir;
        return $this;
    }

    public function getRootDir()
    {
        return $this->root_dir;
    }

    /**
     * @param $width
     * @param $height
     * @return string
     */
    public function getResizedLink($width, $height)
    {
        return $this->dirname . '/'
            . $this->getFilenameWithSize($width, $height)
            . '.' . $this->extension;
    }


}