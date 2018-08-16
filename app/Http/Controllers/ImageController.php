<?php

namespace App\Http\Controllers;


use App\Doctor;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function resizeImages()
    {
        foreach (Doctor::whereNull('original_image')->orderBy('avg_rate', 'desc')->get() as $doctor){
            if(isset($doctor->avatar) && $doctor->avatar != 'http://idoctor.local/images/no-userpic.gif' && file_exists($doctor->avatar)){
                $doctor->original_image = $doctor->avatar;
                $img = $doctor->avatar;
                $img = Image::make($img);

                $img->fit(200, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });

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