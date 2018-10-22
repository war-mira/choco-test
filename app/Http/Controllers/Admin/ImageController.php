<?php

namespace App\Http\Controllers\Admin;

use App\Components\Image\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        

        $file = $request->file('file');
        $image = new UploadImage($file);
        return response()->json($image->getInfo());
    }
}
