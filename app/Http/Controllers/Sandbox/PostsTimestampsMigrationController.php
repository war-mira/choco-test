<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;
use App\Post;
use Carbon\Carbon;

class PostsTimestampsMigrationController extends Controller
{
    public function migrateTimestamps()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $createdAt = Carbon::createFromTimestamp($post->date_create)->format('Y-m-d H:i:s');
            $updatedAt = Carbon::createFromTimestamp($post->date_update)->format('Y-m-d H:i:s');
            $post->created_at = $createdAt;
            $post->updated_at = $updatedAt;
            $post->save();
        }
    }
}
