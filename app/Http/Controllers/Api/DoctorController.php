<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Cabinet\Doctor\DoctorCabinetController;
use App\Http\Controllers\Cabinet\Doctor\DoctorCabinetPersonalController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class DoctorController extends DoctorCabinetController
{
    public function update(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'middlename' => 'required|max:255',
            'email' => 'email|required|max:255',
            'phone' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            $errors = (new ValidationException($validator))->errors();
            return response()->json(['errors' => $errors
            ], 500);
        } else {
            $doctor = $this->doctor;
            $data = $request->all();
            $doctor->fill($data);
            $doctor->save();

            $user = $this->user;
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->birthday = $request->input('birthday');
            $user->save();
            return response()->json([
                'msg' => 'Сохранено'
            ]);
        }

    }


}
