<?php

namespace App\Http\Resources\Admin\Medcenter;

use App\Http\Resources\Base\TableRowResource;

class MedcenterTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'alias',
        'status_name'
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
            'city_name'  => $resource['city']['name'],
            'created_at' => isset($resource['created_at']) ? $resource['created_at']->format('Y-m-d H:i:s'):null,
            'updated_at' => isset($resource['updated_at']) ? $resource['updated_at']->format('Y-m-d H:i:s'):null
        ];
    }
}
