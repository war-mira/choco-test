<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.10.2018
 * Time: 10:58
 */

namespace App\Components\Image;




use App\Image;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image as Intervention;

class UploadImage
{
    /**
     * @var $image \Intervention\Image\Image
     */
    public $name;
    public $hash;
    public $extension;

    /*
     * Path in storage/app/public
     */
    public $path;
    public $disk;
    private $file;
    public function __construct(UploadedFile $file,$disk = 'public',$path = 'images')
    {
        $this->file = $file;
        $this->disk  = $disk;
        $this->path = $path;
        $this->extension = $file->getClientOriginalExtension();
        $this->name = $file->getClientOriginalName();
        $this->createHash();
        $this->saveToStorage();
        $this->saveToDb();
    }


    public function createHash()
    {
        $this->hash = md5(time() . $this->name);
    }

    public function getFilename()
    {
        return $this->hash.'.'.$this->extension;
    }

    public function getPathToFile()
    {
        return $this->path.'/'.$this->getFilename();
    }
    public function saveToStorage()
    {
        try{
            \Storage::disk($this->disk)->putFileAs($this->path,$this->file,$this->getFilename());
        } catch (\Exception $e){

        }

    }

    public function saveToDb()
    {
        $model = new Image();
        $model->name = $this->name;
        $model->extension = $this->extension;
        $model->path = $this->path;
        $model->hash = $this->hash;
        $model->save();

    }

    public function getInfo()
    {
        return (object)[
            'filename' => $this->getFilename(),
            'realName' => $this->name,
            'hash' => $this->hash,
            'extension' => $this->extension,
            'path' => $this->getPathToFile(),
            'src' => '/storage/'.$this->getPathToFile(),
        ];
    }
}