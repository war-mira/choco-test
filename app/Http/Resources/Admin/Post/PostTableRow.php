<?php

namespace App\Http\Resources\Admin\Post;

use App\Http\Resources\Base\TableRowResource;
use Illuminate\Http\Resources\Json\Resource;

class PostTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'title',
        'alias',
        'content_lite',
        'status_name'
    ];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
