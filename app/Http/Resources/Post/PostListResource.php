<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\Resource;

class PostListResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'posts'=> PostCardResource::collection($this->resource)->toArray($request),
            'pagination'=>$this->resource->links('vendor.pagination.compact')
        ];
    }
}
