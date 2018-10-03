<?php

namespace App\Http\Resources\Admin\City;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class CityTable extends TableResource
{
    protected $rowResource = CommentTableRow::class;
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
