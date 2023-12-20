<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return back()->with('status', 'Comment posted successfully!');
    }

    public function toggleLike(Comment $comment)
    {
        if ($comment->isLikedByUser(auth()->user())) {
            $comment->likes()->detach(auth()->id());
        } else {
            $comment->likes()->attach(auth()->id());
        }

        return back();
    }
}

