<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all posts and their comments and the user who posted the comment
        $posts = Post::with(['comments.user', 'user'])->latest()->get();

        // Pass the posts to the dashboard view
        return view('dashboard', compact('posts'));
    }
}
