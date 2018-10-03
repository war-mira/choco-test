<?php

namespace App\Http\Resources\Admin\Order;

use App\Http\Resources\Base\TableRowResource;

class OrderTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'client_name',
        'client_phone',
        'order',
        'callback_id',
        'status',
        'status_name',
        'target_type_name',
        'target'
    ];

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

    protected function getAppends($resource, $request)
    {
        return [
            'created_at' => isset($resource['created_at']) ? $resource['created_at']->format('Y-m-d H:i:s') : null,
            'updated_at' => isset($resource['updated_at']) ? $resource['updated_at']->format('Y-m-d H:i:s') : null
        ];
    }
}
