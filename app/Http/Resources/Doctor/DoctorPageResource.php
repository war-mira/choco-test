<?php

namespace App\Http\Resources\Doctor;

use App\Enums\MedicalServiceType;
use App\MedicalService;
use Illuminate\Http\Resources\Json\Resource;

class DoctorPageResource extends Resource
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
        $title = $doctor->meta_title ?? ($doctor->firstname . ' ' . $doctor->lastname . ' - ' . $doctor->city->name);
        $description = $doctor->meta_desc ?? (substr(strip_tags(str_replace('\r\n', '', $doctor->content)), 0, 256));
        $keywords = $doctor->meta_key ?? null;

        $uncategorizedServices = MedicalService::query()
            ->where('medical_services.type', MedicalServiceType::SERVICE)
            ->whereNull('medical_services.parent_id')
            ->with(['offers' => function ($offerQuery) use ($doctor) {
                $offerQuery
                    ->where('provider_type', '=', 'DoctorJob')
                    ->whereIn('provider_id', $doctor->jobs()->pluck('id'));
            }, 'offers.service'])
            ->whereHas('offers')
            ->get();

        $offerCategories = MedicalService::query()
            ->where('type', MedicalServiceType::CATEGORY)
            ->with(['children.offers' => function ($offerQuery) use ($doctor) {
                $offerQuery
                    ->where('provider_type', '=', 'DoctorJob')
                    ->whereIn('provider_id', $doctor->jobs()->pluck('id'));
            }, 'children.offers.service'])
            ->whereHas('children.offers')
            ->get()
            ->prepend([
                'name'     => 'Услуги',
                'children' => $uncategorizedServices
            ])->map(function ($offerCategory) {
                return [
                    'name'   => $offerCategory['name'],
                    'offers' => $offerCategory['children']->pluck('offers')->flatten()
                ];
            });


        return [
            'meta' => compact('title', 'description', 'keywords'),

            'doctor' => [
                'id'                      => $doctor->id,
                'alias'                   => $doctor->alias,
                'name'                    => $doctor->name,
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
                'links'                   => [
                    'load_comments' => route('doctor.comments.get', ['doctor' => $doctor]),
                    'leave_comment' => route('doctor.comments.create', ['doctor' => $doctor])
                ],
                'offers'                  => $offerCategories,
                'about_text'              => $doctor->about_text,
                'treatment_text'          => $doctor->treatment_text,
                'exp_text'                => $doctor->exp_text,
                'grad_text'               => $doctor->grad_text,
                'community_text'          => $doctor->community_text,
                'certs_text'              => $doctor->certs_text,
            ]
        ];
    }
}
