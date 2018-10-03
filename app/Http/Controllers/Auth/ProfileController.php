<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.11.2017
 * Time: 15:10
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        if (Auth::guest())
            return redirect('/login');
        $user = Auth::user();

        $name = $request->input('name', false);
        $email = $request->input('email', false);
        $phone = $request->input('phone', false);
        $city_id = $request->input('city_id', false);

        $newPassword = $request->input('new_password');
        $newPasswordConfirm = $request->input('new_password_confirm', false);

        $old_password = $request->input('old_password', false);
        $checkPassword = \Hash::check($old_password, $user->password);

        if ($checkPassword) {
            if ($name)
                $user->name = $name;
            if ($email)
                $user->email = $email;
            if ($phone)
                $user->phone = $phone;
            if ($city_id !== false)
                $user->city_id = $city_id;

            if ($newPassword && $newPassword === $newPasswordConfirm)
                $user->password = bcrypt($newPassword);
            $user->save();
        }
        return redirect('/user/profile');
    }
}