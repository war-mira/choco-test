<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\Resource;

class DoctorCardResource extends Resource
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
            'id'                      => $doctor->id,
            'name'                    => $doctor->name,
            'alias'                   => $doctor->alias,
            'avatar'                  => asset($doctor->avatar),
            'href'                    => route('doctor.item', ['doctor' => $doctor]),
            'avg_rate'                => $doctor->avg_rate,
            'comments_count'          => $doctor->publicComments()->count(),
            'positive_comments_count' => $doctor->publicComments()->where('author_rate', '>=', 5)->count(),
            'negative_comments_count' => $doctor->publicComments()->where('author_rate', '<', 5)->count(),
            'skills_list'             => $doctor->skills()->pluck('name')->implode(' / '),
            'qualification'           => $doctor->qualification,
            'exp'                     => $doctor->exp_formatted,
            'ambulatory'              => $doctor['ambulatory'] ? 'Да' : 'Нет',
            'child'                   => $doctor['child'] ? 'Да' : 'Нет',
            'medcenters'              => $doctor->medcenters,
            'price'                   => $doctor->price,
        ];
    }
}
