<?php

namespace App\Http\Resources\Admin\Post;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class PostTable extends TableResource
{
    protected $rowResource = PostTableRow::class;
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
