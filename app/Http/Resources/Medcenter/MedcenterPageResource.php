<?php

namespace App\Http\Resources\Medcenter;

use App\Enums\DoctorStatus;
use App\Medcenter;
use App\Skill;
use Illuminate\Http\Resources\Json\Resource;

class MedcenterPageResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Medcenter $medcenter */
        $medcenter = $this->resource;

        $comments = [
            'count' => [
                'total'    => $medcenter->publicComments()->count(),
                'positive' => $medcenter->publicComments()->where('comments.author_rate', '>=', 5)->count(),
                'negative' => $medcenter->publicComments()->where('comments.author_rate', '<', 5)->count()
            ],
            'links' => [
                'get'    => route('medcenter.comments.get', ['medcenter' => $medcenter]),
                'create' => route('medcenter.comments.get', ['medcenter' => $medcenter])
            ]
        ];

        $doctors = [
            'count' => [
                'total' => $medcenter->publicDoctors()->count()
            ],
            'links' => [
                'get' => route('medcenter.doctors.get', ['medcenter' => $medcenter])
            ]
        ];

        $skillItems = Skill::query()
            ->withCount(['doctors as medcenter_doctors' => function ($doctorsQuery) use ($medcenter) {
                $doctorsQuery
                    ->where('doctors.status', DoctorStatus::VISIBLE)
                    ->whereHas('jobs', function ($jobQuery) use ($medcenter) {
                        $jobQuery->where('doctor_jobs.medcenter_id', $medcenter->id);
                    });
            }])->having('medcenter_doctors', '>', 0)->get();

        $skills = [
            'total' => $skillItems->count(),
            'items' => $skillItems

        ];

        $doctorsCount = $medcenter
            ->doctors()
            ->where('doctors.status', DoctorStatus::VISIBLE)
            ->selectRaw('count(*) as total')
            ->first(['total'])->only(['total']);

        return [
            'meta' => compact('title', 'description', 'keywords'),

            'medcenter' => [
                'id'           => $medcenter->id,
                'alias'        => $medcenter->alias,
                'name'         => $medcenter->name,
                'avatar'       => asset($medcenter->avatar),
                'href'         => route('doctor.item', ['doctor' => $medcenter]),
                'avg_rate'     => $medcenter->avg_rate,
                'map'          => $medcenter->map,
                'price'        => $medcenter->price,
                'content_lite' => $medcenter->content_lite,
                'doctors'      => $doctors,
                'comments'     => $comments,
                'skills'       => $skills
            ]
        ];
    }
}
