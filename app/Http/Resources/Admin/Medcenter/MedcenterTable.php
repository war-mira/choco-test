<?php

namespace App\Http\Resources\Admin\Medcenter;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class MedcenterTable extends TableResource
{
    protected $rowResource = MedcenterTableRow::class;
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
