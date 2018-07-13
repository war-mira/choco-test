<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.11.2017
 * Time: 15:45
 */

namespace App\Http\Controllers\Cabinet\Doctor;

use Illuminate\Http\Request;

class DoctorCabinetPersonalController extends DoctorCabinetController
{
    public function index(){
        return view('cabinet.doctor.personal.index', ['doctor' => $this->doctor, 'user' => $this->user]);
    }

    public function edit(){
        return view('cabinet.doctor.personal.edit', ['doctor' => $this->doctor, 'user' => $this->user]);
    }

    public function update(Request $request){
        $doctor = $this->doctor;
        $data = $request->all();
        $doctor->fill($data);
        $doctor->save();

        $user = $this->user;
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->back();
    }

    public function photoUpload(Request $request){
        $doctor = $this->doctor;
        if($request->file('file')){
            $avatar = $request->file('file')->store('images');
            $doctor->avatar = $avatar;
            $doctor->save();

            return 'success';
        }
    }




}