<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use App\Model\Auth\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PhoneVerificationController extends Controller
{
    const RETRY_TIMEOUT = 60;

    public function phoneVerification(Request $request)
    {
        return view('auth.phone-verify');
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

            $latestRequestDT = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $verifications->max('request_timestamp'));
            $left = self::RETRY_TIMEOUT - now()->diffInSeconds($latestRequestDT);
            $response = redirect(route('user.phone.verification.form'))
                ->withErrors(['phone' => 'Превышен лимит запросов. Подождите.']);
        } else {
            $verifications->update(['status' => -1]);
            $verification = $this->createVerification($user, $phone, 600);
            $user->phone_verified = false;
            $user->phone = $phone;
            $user->save();
            $response = redirect(route('user.phone.verification.check-form'));
        }
        return $response;
    }

    private function createVerification($user, $phone, $expireTime)
    {
        $now = now();
        $expires = now()->addSeconds($expireTime);
        $code = (string)rand(1000, 9999);
        $verification = PhoneVerification::query()->create([
            'user_id'           => $user->id,
            'phone'             => $phone,
            'request_timestamp' => $now,
            'expire_timestamp'  => $expires,
            'status'            => 0,
            'verify_code'       => $code
        ]);
        $result = \SmsService::send([
            'recipient' => $phone,
            'text'      => 'iDoctor код - ' . $code . '.'
        ]);
        if ($result)
            $verification->update(['status' => 1]);
        return $verification;
    }

    public function codeVerification(Request $request)
    {
        return view('auth.phone-verify-check');
    }

    public function verifyCode(Request $request)
    {
        $user = \Auth::user();
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
                $response = response(
                    ['success' =>
                         [
                             'message'  => 'Ваш аккаунт теперь под надежной защитой! Через несколько секунды вы будете '
                                 . 'перенаправлены в свой профиль. Благодарим за терпение.',
                             'redirect' => route('user.profile')
                         ]], 200);
            } else {
                $response = response(['error' => ['message' => 'Неверный код!']], 400);
            }
        } else {
            $response = response(['error' => ['message' => 'Вы еще не запрашивали код!']], 400);
        }


        return $response;

    }
}
