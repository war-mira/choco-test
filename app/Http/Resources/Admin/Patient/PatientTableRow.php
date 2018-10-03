<?php

namespace App\Http\Resources\Admin\Patient;

use App\Http\Resources\Base\TableRowResource;
use Illuminate\Http\Resources\Json\Resource;

class PatientTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'birthday',
        'city',
        'phone'
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
            'city_name'  => $resource['city']['name'],
            'birthday'   => isset($resource['birthday']) ? $resource['birthday']->format('Y-m-d') : null,
            'created_at' => isset($resource['created_at']) ? $resource['created_at']->format('Y-m-d H:i:s') : null
        ];
    }
}
