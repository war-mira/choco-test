<?php

namespace App\Http\Controllers;

use App\Models\Library\IllnessesGroupArticle;
use App\Post;

class PostController extends Controller
{
    public function item($alias)
    {

        $post = Post::where('status', 1)
            ->where('alias', $alias)
            ->first();

        if(!$post){
            $article = IllnessesGroupArticle::where('alias',$alias)->firstOrFail();
            return redirect()->route('library.illnesses-group-article',[
                'illnesses_group' => $article->group->alias,
                'article' => $article->alias
            ]);
        }

        $links = $this->getNavigationFromContent($post->content);

        $meta = $post->getMetadata();

        $post->content = str_replace(
            [
                'href="http://',
                'https://www.rstom.kz',
                'href="https://plus.google.com',
                'href="https://twitter.com',
                'href="https://vk.com',
                'href="https://www.facebook.com',
                'doctors/almaty',
                'doctors/kazakhstan',
            ],
            [
                'href="https://',
                'http://www.rstom.kz',
                'rel="nofollow" href="https://plus.google.com',
                'rel="nofollow" href="https://twitter.com',
                'rel="nofollow" href="https://vk.com',
                'rel="nofollow" href="https://www.facebook.com',
                'almaty/doctors',
                'kazakhstan/doctors',
            ],
            str_replace(['rel="publisher"'], "", $post->content)
        );

        return view('library.posts.item', compact('post', 'meta', 'links'));
    }

    public function list()
    {
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->orderBy('is_top', 'desc')
            ->paginate(15);
        return view('library.posts.list', compact('posts'));
    }

    private function getNavigationFromContent($content) {
        $regex = '#<\s*?h2\b[^>]*>(.*?)</h2\b[^>]*>#s';
        preg_match_all($regex, $content, $m);

        return $m[1];
    }

}
