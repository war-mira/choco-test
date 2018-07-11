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

        $post->content = str_replace(
            [
                'href="http://',
                'https://www.rstom.kz',
                'href="https://plus.google.com',
                'href="https://twitter.com',
                'href="https://vk.com',
                'href="https://www.facebook.com',
            ],
            [
                'href="https://',
                'http://www.rstom.kz',
                'rel="nofollow" href="https://plus.google.com',
                'rel="nofollow" href="https://twitter.com',
                'rel="nofollow" href="https://vk.com',
                'rel="nofollow" href="https://www.facebook.com',
            ],
            str_replace(['rel="publisher"'], "", $post->content)
        );

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
