<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request, $video_id)
    {
        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->video_id = $video_id;
        $comment->content = request('content');
        $comment->save();
        return redirect()->back()->with('message', 'Comment has been added this video');
    }

    public function update($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->content = request('content');
        $comment->save();
        return redirect()->back()->with('message', 'Comment has been updated on this post');
    }

    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->destroy();
        return redirect()->back()->with('message', 'Comment has been deleated on this post');
    }
}
