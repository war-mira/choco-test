<?php

namespace App\Http\Resources\Admin\Comment;

use App\Http\Resources\Base\TableRowResource;

class CommentTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'alias',
        'author_name',
        'author_phone',
        'author_rate',
        'status',
        'owner',
        'text',
        'status_name'
    ];

    protected function getAppends($resource, $request)
    {
        return [
            'created_at' => isset($resource['created_at']) ? $resource['created_at']->format('Y-m-d H:i:s'):null,
            'updated_at' => isset($resource['updated_at']) ? $resource['updated_at']->format('Y-m-d H:i:s'):null
        ];
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
