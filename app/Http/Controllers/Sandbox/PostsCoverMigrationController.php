<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;
use App\Image;
use App\Post;

class PostsCoverMigrationController extends Controller
{
    public function migrateCovers()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->cover_image = Image::post($post->id)->path ?? '';
            $post->save();
        }
    }
}
