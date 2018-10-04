<?php

namespace App\Http\Resources\Admin\Patient;

use Illuminate\Http\Resources\Json\Resource;

class PatientFormResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'firstname'  => $this->firstname,
            'lastname'   => $this->lastname,
            'middlename' => $this->middlename,
            'birthday'   => isset($this->birthday) ? $this->birthday->format('Y-m-d') : null,
            'city_id'    => $this->city_id,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'phone2'     => $this->phone2
        ];
    }
}
