<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Cabinet\Doctor\DoctorCabinetController;
use App\Http\Controllers\Cabinet\Doctor\DoctorCabinetPersonalController;
use App\Rules\PhoneNumber;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = \Auth::user();
    }
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => ['required', new PhoneNumber, Rule::unique('users')->where('phone_verified', 1)],
        ]);
        if ($validator->fails()) {
            $errors = (new ValidationException($validator))->errors();
            return response()->json(['errors' => $errors
            ], 500);
        } else {
            $this->user->update($request->all());
            return response()->json([
                'msg'=>'Сохранено'
            ]);
        }

    }
    public function updatePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            $errors = (new ValidationException($validator))->errors();
            return response()->json(['errors' => $errors
            ], 500);
        } else {
            $this->user->password = bcrypt($request->get('password'));
            $this->user->save();
            return response()->json([
                'msg'=>'Сохранено'
            ]);
        }

    }

}
