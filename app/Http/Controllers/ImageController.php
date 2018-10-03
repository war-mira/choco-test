<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.08.2018
 * Time: 16:27
 */

namespace App\Http\Controllers;


use App\Doctor;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function resizeImages()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        foreach (Doctor::whereNull('image_updated')->orWhere('image_updated', 0)->orderBy('avg_rate', 'desc')->get() as $doctor){
            if(isset($doctor->avatar) && $doctor->avatar != 'http://idoctor.local/images/no-userpic.gif' && file_exists($doctor->avatar)){

                    $doctor->image_updated = 1;
                    $img = $doctor->original_image;
                    $img = Image::make($img);

//                dd($img->height());
//                if($img->width > $img->height()){
//                    $img->crop(200, 300, function ($constraint) {
//                        $constraint->aspectRatio();
//                    });
//                }
                    $img->fit(300, null, null, 'top');
                    if (!file_exists('images/doctors/'.$doctor->id.'/')) {
                        mkdir('images/doctors/'.$doctor->id.'/', 0777, true);
                    }
                    $path = 'images/doctors/'.$doctor->id.'/'.$img->basename;
                    $img->save($path);
                    $doctor->avatar = $path;
                    $doctor->update();

            }
        }
    }
}