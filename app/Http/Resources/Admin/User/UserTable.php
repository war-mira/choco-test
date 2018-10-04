<?php

namespace App\Http\Resources\Admin\User;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class UserTable extends TableResource
{
    protected $rowResource = UserTableRow::class;
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
