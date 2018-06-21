<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentReplyController extends Controller
{
    public function create(Request $request)
    {
        $ownerId = $request->input('owner_id');
        $text = $request->input('text');
        $authorId = \Auth::user()->id;

        $comment = Comment::find($ownerId);
        $comment->replies()->create([
            'text' => $text,
            'author_id' => $authorId,
            'user_rate' => 10,
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp
        ]);
        return $comment;

    }

    public function save(Request $request)
    {
        $commentId = $request->input('reply_id');
        $text = $request->input('text');

        $comment = Comment::find($commentId);
        $comment->text = $text;
        $comment->updated_at = Carbon::now()->timestamp;
        $comment->save();
        return $comment;
    }

    public function delete(Request $request)
    {
        $commentId = $request->input('reply_id');

        $comment = Comment::find($commentId)->delete();

        return response('');
    }

}
