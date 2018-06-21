<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function item($alias)
    {

        $post = Post::where('status', 1)
            ->where('alias', $alias)
            ->firstOrFail();

        $meta = $post->getMetadata();

        return view('posts.item', compact('post', 'meta'));
    }

    public function list()
    {
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->orderBy('is_top', 'desc')
            ->paginate(15);
        return view('posts.list', compact('posts'));
    }


}
