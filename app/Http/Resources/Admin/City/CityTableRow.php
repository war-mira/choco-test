<?php

namespace App\Http\Resources\Admin\City;

use App\Http\Resources\Base\TableRowResource;

class CityTableRow extends TableRowResource
{
    protected $visible = [
        'id',
        'name',
        'alias'
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
