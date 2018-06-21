<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.11.2017
 * Time: 10:55
 */

namespace App\Http\Controllers\Sandbox;


use App\Banner;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Image;
use App\Medcenter;
use Illuminate\Http\Request;

class ImageStorageController extends Controller
{
    private function getImageFiles()
    {
        $imgsFolder = public_path('/images');
        $photosFolder = public_path('/photos');
        $imgsFiles = array_map(function ($filename) {
            return 'images/' . $filename;
        }, scandir($imgsFolder));
        $photosFiles = array_map(function ($filename) {
            return 'photos/' . $filename;
        }, scandir($photosFolder));
        $files = array_merge($imgsFiles, $photosFiles);

        $images = array_filter($files, function ($file) {
            if ($file == '.' || $file == '..')
                return false;
            $path = public_path($file);
            return is_file($path);
        });
        return $images;
    }

    public function enumImages()
    {
        return response()->json($this->getImageFiles());
    }

    public function checkBindings()
    {
        $images = $this->getImageFiles();
        $bindings = [];
        foreach ($images as $image) {
            $doctorsCount = Doctor::query()->where('avatar', 'like', "%" . $image . "%")->count();
            $medcentersCount = Medcenter::query()->where('avatar', 'like', "%" . $image . "%")->count();
            $imagesCount = Image::query()->where('path', 'like', "%" . $image . "%")->count();
            $bannersCount = Banner::query()->where('image_file_desktop', 'like', "%" . $image . "%")->orWhere('image_file_mobile', 'like', "%" . $image . "%")->count();
            $bindings[] = [
                'file' => $image,
                'size' => filesize(public_path($image)),
                'doctors' => $doctorsCount,
                'medcenters' => $medcentersCount,
                'images' => $imagesCount,
                'banners' => $bannersCount,
                'total' => $doctorsCount + $medcentersCount + $imagesCount + $bannersCount
            ];
        }
        $bindings = array_sort($bindings, function ($item) {
            return $item['total'];
        });
        return view('sandbox.imageBindings')->with(compact('bindings'));
    }

    public function removeImages(Request $request)
    {
        $images = $request->input('imgFiles', []);
        $view = '';
        foreach ($images as $image) {
            $path = public_path($image);
            unlink($path);
            $view .= $path . '<br>';
        }
        return $view;

    }
}