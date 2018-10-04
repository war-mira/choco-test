<?php

namespace App\Http\Resources\Admin\Order;

use App\Http\Resources\Base\TableResource;

class OrderTable extends TableResource
{
    protected $rowResource = OrderTableRow::class;

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
