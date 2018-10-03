<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\Resource;

class DoctorOfferResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'service_id'    => $this->service->id,
            'name'          => $this->service->name,
            'provider_id'   => $this->provider_id,
            'provider_type' => $this->provider_type,
            'type'          => $this->service['parent']['name'] ?? 'Услуги',
            'price'         => $this->price,
            'discount'      => $this->discount
        ];
    }
}
