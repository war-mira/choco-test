<?php

namespace App\Http\Controllers;

use App\Model\Feedback;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{



    public function create(Request $request)
    {
        $data = $request->only([
            'name',
            'phone',
            'email',
            'text']);
        $feedback = new Feedback($data);
        if (auth()->user())
            $feedback->user_id = auth()->user()->id;

        $feedback->save();
    }


    public function index()
    {

        return User::find(12884)->doctor
            ->comments()->orderBy('id','desc')->paginate(10)
            ;
//        return Auth::user()->doctor->comments;
    }
}
