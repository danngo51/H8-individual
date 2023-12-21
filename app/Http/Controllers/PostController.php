<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subpage;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class PostController extends Controller
{
     // Show a form for creating a new post in a subpage
     public function create(Subpage $subpage)
     {
         return view('posts.create', compact('subpage'));
     }
 
    public function store(Request $request, Subpage $subpage)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->subpage_id = $subpage->id;
        $post->save();

        return redirect()->route('subpages.show', $subpage);
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