<?php

namespace App\Http\Resources\Admin\Doctor;

use App\Http\Resources\Admin\Medcenter\MedcenterTableRow;
use App\Http\Resources\Admin\Skill\SkillTableRow;
use App\Http\Resources\Base\TableRowResource;
use Illuminate\Http\Resources\Json\Resource;

class DoctorTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'firstname',
        'lastname',
        'patronymic',
        'alias',
        'status_name',

    ];

    protected function getAppends($resource, $request)
    {
        return [
            'city_name' => $resource['city']['name'],
            'created_at' => isset($resource['created_at']) ? $resource['created_at']->format('Y-m-d H:i:s'):null,
            'updated_at' => isset($resource['updated_at']) ? $resource['updated_at']->format('Y-m-d H:i:s'):null,
            'skills'=>SkillTableRow::collection($resource['skills'])->toArray($request),
            'medcenters'=>MedcenterTableRow::collection($resource['medcenters'])->toArray($request)
        ];
    }

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
