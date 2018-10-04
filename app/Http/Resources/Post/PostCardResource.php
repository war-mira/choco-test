<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\Resource;

class PostCardResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $post = $this->resource;
        return [
            'title'       => $post->title,
            'created_at'  => $post->created_at->format('d.m.Y'),
            'cover_image' => asset($post->cover_image),
            'href'=>route('posts.item',$post)
        ];
    }
}
