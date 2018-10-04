<?php

namespace App\Http\Resources\Admin\MedicalService;

use App\Http\Resources\Admin\Medcenter\MedcenterTableRow;
use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class MedicalServiceTable extends TableResource
{
    protected $rowResource = MedicalServiceTableRow::class;
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
