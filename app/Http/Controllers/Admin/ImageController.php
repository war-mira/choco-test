<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
      $file  =  $request->file('file');
      \Storage::disk('public')->putFileAs('images',$file,'name.jpeg');
    }
}
