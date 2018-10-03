<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.02.2018
 * Time: 15:32
 */

namespace App\Http\Controllers\Auth;


use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use App\Model\Auth\PhonePasswordReset;
use App\User;
use Illuminate\Http\Request;

class PhonePasswordResetController extends Controller
{
    public function showCodeRequestForm()
    {
        return view('auth.passwords.phone-reset.request');
    }

    public function requestResetCode(Request $request)
    {
        $phone = $request->input('phone', false);

        if ($phone) {
            $phone = FormatHelper::phone($phone);
            $user = User::query()
                ->where('role', '!=', '3')
                ->where('phone', $phone)
                ->where('phone_verified', 1)
                ->first();
            if (!$user)
                return redirect()->back()->withErrors(['phone' => 'Пользователь с таким номером телефона не найден!'])->withInput();
            $token = session()->token();
            $code = (string)rand(1000, 9999);


            $expires = now()->addHour();
            $reset = new PhonePasswordReset();
            $reset->fill([
                'user_id'       => $user->id,
                'session_token' => $token,
                'phone'         => $phone,
                'code'          => $code,
                'expires_at'    => $expires,
                'status'        => PhonePasswordReset::STATUS_REQUESTED
            ]);
            $reset->save();

            $sms = \SmsService::send([
                'recipient' => $phone,
                'text'      => 'iDoctor код - ' . $code
            ]);
            if ($sms) {
                $reset->update(['status' => PhonePasswordReset::STATUS_SENT]);
                return redirect()->route('password.phone.code-confirm-form');
            } else {
                $reset->update(['status' => PhonePasswordReset::STATUS_FAILED]);
                return redirect()->back();

            }
        }
    }

    public function showCodeConfirmForm()
    {
        $token = session()->token();
        $reset = PhonePasswordReset::query()->where('session_token', $token)->orderByDesc('id')->first();
        $phone = $reset->phone ?? null;
        if ($reset->status == PhonePasswordReset::STATUS_SENT)
            return view('auth.passwords.phone-reset.code', compact('phone'));
        else
            return redirect()->route('password.phone.request-form');
    }

    public function confirmCode(Request $request)
    {
        $code = $request->input('code', false);
        $token = session()->token();

        $reset = PhonePasswordReset::query()
            ->where('expires_at', '>', now())
            ->where('session_token', $token)
            ->orderByDesc('id')
            ->first();
        if ($reset) {
            if ($reset->code == $code && $reset->status == PhonePasswordReset::STATUS_SENT) {
                $reset->update(['status' => PhonePasswordReset::STATUS_ACTIVE]);
                $resetToken = str_random(40);
                $reset->reset_token = $resetToken;
                $reset->save();
                return redirect()->route('password.phone.reset-form', ['reset_token' => $resetToken]);
            }
        }

    }

    public function showPasswordResetForm(Request $request)
    {
        $resetToken = $request->input('reset_token', false);
        $reset = PhonePasswordReset::query()
            ->where('expires_at', '>', now())
            ->where('reset_token', $resetToken)
            ->orderByDesc('id')->first();
        if ($reset && $reset->status == PhonePasswordReset::STATUS_ACTIVE)
            return view('auth.passwords.phone-reset.reset', compact('resetToken'));
        else
            return redirect()->route('password.phone.code-confirm-form');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'reset_token' => 'required|max:40',
            'password'    => 'required|min:6|max:50|confirmed',
        ]);

        $resetToken = $request->input('reset_token', false);

        $reset = PhonePasswordReset::query()
            ->where('expires_at', '>', now())
            ->where('reset_token', $resetToken)
            ->orderByDesc('id')->first();

        if ($reset && $reset->status == PhonePasswordReset::STATUS_ACTIVE) {
            $user = $reset->user;
            $password = $request->input('password', false);

            $reset->is_valid = false;

            $user->password = bcrypt($password);
            $user->phone_verified = true;
            $user->save();
            \Auth::login($user);
            return redirect()->route('user.profile');
        }
    }

}