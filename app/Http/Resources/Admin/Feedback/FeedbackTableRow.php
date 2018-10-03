<?php

namespace App\Http\Resources\Admin\Feedback;

use App\Http\Resources\Base\TableRowResource;
use Illuminate\Http\Resources\Json\Resource;

class FeedbackTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'phone',
        'email',
        'text',
        'status'
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

    protected function getAppends($resource, $request)
    {
        return [
            'author_name'  => $resource['user']['name'] ?? '-',
            'created_at' => isset($resource['created_at']) ? $resource['created_at']->format('Y-m-d H:i:s'):null,
            'updated_at' => isset($resource['updated_at']) ? $resource['updated_at']->format('Y-m-d H:i:s'):null
        ];
    }
}
