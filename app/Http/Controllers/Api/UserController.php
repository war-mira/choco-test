<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatHelper;
use App\Http\Controllers\Cabinet\Doctor\DoctorCabinetController;
use App\Http\Controllers\Cabinet\Doctor\DoctorCabinetPersonalController;
use App\Model\Auth\PhoneVerification;
use App\Rules\PhoneNumber;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    const RETRY_TIMEOUT = 60;

    public function __construct()
    {
        $this->user = \Auth::user();
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            $errors = (new ValidationException($validator))->errors();
            return response()->json(['errors' => $errors
            ], 400);
        } else {
            $this->user->update($request->all());
            return response()->json([
                'msg' => 'Сохранено'
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
            ], 400);
        } else {
            $this->user->password = bcrypt($request->get('password'));
            $this->user->save();
            return response()->json([
                'msg' => 'Сохранено'
            ]);
        }

    }
    public function checkCode(Request $request)
    {
        $user = $this->user;
        $now = now();
        $code = $request->input('code');

        $verifications = PhoneVerification::query()
            ->where('status', 1)
            ->where('user_id', $user->id)
            ->where('expire_timestamp', '>=', $now);


        $verification = $verifications->first();
        if (isset($verification)) {
            if ($verification->phone == $user->phone && $user->phone_verified) {
                $response = response(['error' => ['message' => 'Вы уже подтвердили этот номер!']], 400);
            } else if ($verification->verify_code == $code) {
                $verification->update(['status' => 2]);
                $user->phone = $verification->phone;
                $user->phone_verified = true;
                $user->save();

                if($user->role == User::ROLE_DOCTOR){
                    $redirect = route('cabinet.doctor.personal.index');
                } else {
                    $redirect = route('user.profile');
                }

                $response = response(
                    ['success' =>
                        [
                            'message'  => 'Ваш аккаунт теперь под надежной защитой! Через несколько секунды вы будете '
                                . 'перенаправлены в свой профиль. Благодарим за терпение.',
                            'redirect' => $redirect
                        ]], 200);
            } else {
                $response = response(['error' => ['message' => 'Неверный код!']], 400);
            }
        } else {
            $response = response(['error' => ['message' => 'Вы еще не запрашивали код!']], 400);
        }


        return $response;

    }
    public function requestCode(Request $request)
    {
        $user = \Auth::user();
        $phone = FormatHelper::phone($request->input('phone'));
        $now = now();

        $verifications = PhoneVerification::query()
            ->whereIn('status', [0, 1])
            ->where(function (Builder $query) use ($user, $phone) {
                $query->where('user_id', $user->id);
                $query->orWhere('phone', $phone);
            });
        $pendingVerifications = clone $verifications;
        $pendingVerifications->where('request_timestamp', '>', $now->subSeconds(self::RETRY_TIMEOUT));

        if ($pendingVerifications->count() > 0) {

            return response()->json(['phone' => 'Превышен лимит запросов. Подождите.'], 500);
        } else {
            $verifications->update(['status' => -1]);
            $this->createVerification($user, $phone, 600);
            $user->phone_verified = false;
            $user->phone = $phone;
            $user->save();
            return response()->json([
                'msg' => 'Смс отправлен'
            ]);
        }

    }

    private function createVerification($user, $phone, $expireTime)
    {
        $now = now();
        $expires = now()->addSeconds($expireTime);
        $code = (string)rand(1000, 9999);
        $verification = PhoneVerification::query()->create([
            'user_id' => $user->id,
            'phone' => $phone,
            'request_timestamp' => $now,
            'expire_timestamp' => $expires,
            'status' => 0,
            'verify_code' => $code
        ]);
        $result = \SmsService::send([
            'recipient' => $phone,
            'text' => 'iDoctor код - ' . $code . '.'
        ]);
        if ($result)
            $verification->update(['status' => 1]);
        return $verification;
    }

}
