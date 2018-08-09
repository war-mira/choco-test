<?php

namespace App\Http\Controllers;

use App\Model\Feedback;
use Illuminate\Http\Request;

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
}
