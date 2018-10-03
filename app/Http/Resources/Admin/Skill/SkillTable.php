<?php

namespace App\Http\Resources\Admin\Skill;

use App\Http\Resources\Base\TableResource;
use Illuminate\Http\Resources\Json\Resource;

class SkillTable extends TableResource
{
    protected $rowResource = SkillTableRow::class;
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
