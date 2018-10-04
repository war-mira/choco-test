<?php

namespace App\Http\Resources\Admin\Patient;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class PatientTable extends TableResource
{
    protected $rowResource = PatientTableRow::class;
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
