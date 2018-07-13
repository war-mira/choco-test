<?php

namespace App\Http\Controllers\Cabinet\Doctor;

use App\Skill;
use Illuminate\Http\Request;

class DoctorCabinetProfessionalController extends DoctorCabinetController
{
    public function index(){
        return view('cabinet.doctor.professional.index', ['doctor' => $this->doctor, 'user' => $this->user]);
    }

    public function edit(){
        $skills = Skill::all();
        return view('cabinet.doctor.professional.edit', ['doctor' => $this->doctor, 'user' => $this->user, 'skills' => $skills]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $doctor = $this->doctor;
        $data['child'] = isset($data['child']) == 'on' ? 1 :0;
        $data['ambulatory'] = isset($data['ambulatory']) ? 1 :0;
        $doctor->fill($data);

        $doctor->save();
        $skills = $data['skills'] ?? false;
        if ($skills !== false) {
            $skills = collect($skills)->mapWithKeys(function ($skill) {
                return [$skill['id'] => ['weight' => 0]];
            });
            $doctor->skills()->sync($skills);
        }

        return redirect()->back();
    }

}