<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\Resource;

class DoctorAjaxResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $doctor = $this->resource;

        return [
            'id'          => $doctor->id,
            'alias'       => $doctor->alias,
            'name'        => $doctor->name,
            'avatar'      => asset($doctor->avatar),
            'price'       => $doctor->price,
            'skills_list' => $doctor->skills()->pluck('name')->implode(' / '),
        ];
    }
}
