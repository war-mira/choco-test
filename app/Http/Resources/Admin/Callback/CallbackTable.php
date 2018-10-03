<?php

namespace App\Http\Resources\Admin\Callback;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class CallbackTable extends TableResource
{
    protected $rowResource = CallbackTableRow::class;
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
