<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->save();

        return back()->with('status', 'Post created successfully!');
    }

    public function like(Post $post)
    {
        $like = new Like();
        $like->user_id = auth()->id();
        $like->post_id = $post->id;
        $like->save();

        return back();
    }

    public function toggleLike(Post $post)
{
    
    $like = $post->likes()->where('user_id', Auth::id())->first();

    if ($like) {
        $like->delete();
    } else {
        $post->likes()->create(['user_id' => Auth::id()]);
    }

    return back();
}



}