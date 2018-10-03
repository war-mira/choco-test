<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\Resource;

class PostPageResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $post = $this->resource;
        return [
            'post' => [
                'title'       => $post->title,
                'created_at'  => $post->created_at->format('d.m.Y'),
                'cover_image' => asset($post->cover_image),
                'content'     => str_replace('\r\n', ' ', $post->content)
            ],
            'meta' => $post->getMetadata()
        ];
    }
}
