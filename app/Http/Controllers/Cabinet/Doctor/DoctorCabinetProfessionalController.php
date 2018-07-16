<?php

namespace App\Http\Controllers\Cabinet\Doctor;

use App\Qualification;
use App\Skill;
use Illuminate\Http\Request;

class DoctorCabinetProfessionalController extends DoctorCabinetController
{
    public function index(){
        return view('cabinet.doctor.professional.index', ['doctor' => $this->doctor, 'user' => $this->user]);
    }

    public function edit(){
        $skills = Skill::all();
        $qualifications = Qualification::all();
        return view('cabinet.doctor.professional.edit', ['doctor' => $this->doctor, 'user' => $this->user, 'skills' => $skills, 'qualifications' => $qualifications]);
    }

    public function update(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'qualifications' => 'required|between:1,2'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = $request->all();
            $doctor = $this->doctor;
            $data['child'] = isset($data['child']) == 'on' ? 1 : 0;
            $data['ambulatory'] = isset($data['ambulatory']) ? 1 : 0;
            $data['works_since_year'] = isset($data['works_since_year']) ? preg_replace('/[^0-9]/', '', $data['works_since_year']) : 0;
            $doctor->fill($data);

            $doctor->save();
            $skills = $data['skills'] ?? false;
            if ($skills !== false) {
                $skills = collect($skills)->mapWithKeys(function ($skill) {
                    return [$skill['id'] => ['weight' => 0]];
                });
                $doctor->skills()->sync($skills);
            }
            $qualifications = $data['qualifications'] ?? false;
            if ($qualifications !== false) {
                $qualifications = collect($qualifications)->mapWithKeys(function ($qualification) {
                    return [$qualification['id'] => ['weight' => 0]];
                });
                    $doctor->qualifications()->sync($qualifications);
            }

            return redirect()->back();
        }
    }

}