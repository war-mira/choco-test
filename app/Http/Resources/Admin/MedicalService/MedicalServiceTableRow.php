<?php

namespace App\Http\Resources\Admin\MedicalService;

use App\Http\Resources\Base\TableRowResource;

class MedicalServiceTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'default_price',
        'type_name',
        'parent'
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
}
