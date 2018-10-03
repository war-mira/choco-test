<?php

namespace App\Http\Resources\Admin\Comment;

use App\Http\Resources\Base\TableResource;

class CommentTable extends TableResource
{
    protected $rowResource = CommentTableRow::class;
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
