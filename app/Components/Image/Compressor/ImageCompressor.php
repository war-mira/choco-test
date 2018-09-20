<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.09.2018
 * Time: 11:11
 */

namespace App\Components\Image\Compressor;



use App\Components\Image\ImageResize;

class ImageCompressor
{
    public $optimized_dir = 'optimized';

    /**
     * @param $filename
     * $filename should be with absolute path
     * @param int $quality
     * @param bool $move
     * @throws \Exception
     */
    public function compress($filename,$quality = 85,$move = true)
    {
        $path = pathinfo($filename);
        if(!isset($path['extension'])){
            throw new \Exception('File Extension not found');
        }

        if($path['extension'] == 'jpg'){
            if($move){
                $dest_dir = $path['dirname'].'/'.$this->optimized_dir;
                if (!is_dir($dest_dir)) {
                    mkdir($dest_dir);
                }
            } else{
                $dest_dir = $path['dirname'];
            }
            $output_file = $dest_dir.'/'.$path['filename'].'.'.$path['extension'];

            $options = [
                ''.$filename,
                '-sampling-factor 4:2:0',
                '-strip',
                '-quality '.$quality,
                '-interlace JPEG',
                //$this->isGrayscale($filename)?'':'-colorspace sRGB ',
                ''.$output_file
            ];

            try{
                $command = new Command('convert',$options);
                $command->execute();
            } catch (\Exception $e){

            }
        }
    }

    public function optimizedExist($filename)
    {
        $path = pathinfo($filename);
        $dest_dir = $path['dirname'].'/'.$this->optimized_dir;
        return file_exists($dest_dir.'/'.$path['filename'].'.'.$path['extension']);
    }

}