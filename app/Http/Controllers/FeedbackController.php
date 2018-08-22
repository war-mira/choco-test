<?php

namespace App\Http\Controllers;

use App\Comment;
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

    public function update(Request $request, $reviews){
        if($request->has('reply') && $comment = Comment::find($reviews))

            return $comment->replies()->create([
                'user_rate'  => 10,
                'user_name'  => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'text'       => $request->reply
            ]);


        return false;
    }


    public function index()
    {

        return
//            Auth::user()
            User::find(12884)
                ->doctor
                ->comments()->with('replies')->orderBy('id','desc')->paginate(20);
//        return Auth::user()->doctor->comments;
    }
}
