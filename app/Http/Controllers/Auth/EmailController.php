<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ConfirmEmailPost;
use App\Mail\ConfirmationMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function requestView()
    {
        return view('auth.email-confirm');
    }

    public function changeView()
    {
        return view('auth.email-change');
    }

    public function request(ConfirmEmailPost $request)
    {
        $request->flash();
        $data = $request->all();

        $email = $data['email'];
        $user = Auth::user();
        $user->email = $email;
        $token = str_random(30);
        $user->email_confirmed = false;
        $user->email_confirm_token = $token;
        $user->save();

        Mail::to($email)->send(new ConfirmationMail($token));

        return view('auth.email.confirm-status', ['message' => 'Письмо со ссылкой подтверждения отправлено на почту ' . $email]);
    }

    public function confirm(Request $request, $token)
    {
        $user = User::where('email_confirm_token', $token)->first();
        if ($user != null) {
            $user->email_confirmed = true;
            $user->email_confirm_token = null;
            $user->save();
            $message = 'Email успешно подтвержден!';
        } else {
            $message = 'Токен недействителен или просрочен!';
        }

        return view('auth.email.confirm-status', compact('message'));
    }
}
