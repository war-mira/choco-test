<?php

namespace App\Http\Controllers\Sandbox;

use App\Comment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentsTimestampsMigrationController extends Controller
{
    public function migrateTimestamps(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');

        $comments = Comment::query()->offset($offset)->limit($limit)->get();
        foreach ($comments as $comment) {
            $createdAt = Carbon::createFromTimestamp($comment->created_at_unix)->format('Y-m-d H:i:s');
            $updatedAt = Carbon::createFromTimestamp($comment->updated_at_unix)->format('Y-m-d H:i:s');
            $comment->created_at = $createdAt;
            $comment->updated_at = $updatedAt;
            $comment->save();
        }
    }
}
