<?php

namespace App\Http\Controllers;

use App\Models\Subpage;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSubpageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubpageController extends Controller
{

     // Display the specified subpage
     public function show($slug)
    {
        $subpage = Subpage::with(['posts' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('slug', $slug)->firstOrFail();
        return view('subpages.show', compact('subpage'));
    }

    
    public function subscribed()
    {
        return view('subpages.subscribed');
    }


    // Show the form for creating a new subpage
    public function create()
    {
        return view('subpages.create');
    }

    // Store a newly created subpage
    public function store(CreateSubpageRequest $request) // Using custom request for validation
    {
        $subpage = new Subpage();
        $subpage->name = $request->name; // Ensure this matches your form's input name for the subpage name
        $subpage->description = $request->description; // This can be null, so it's okay if it's not set
        $subpage->owner_id = auth()->id(); // Setting the authenticated user as the owner of the subpage
        $subpage->slug = Str::slug($request->name);
        $subpage->save();

        // Subscribe the user
        auth()->user()->subscriptions()->attach($subpage->id);
        
        return redirect()->route('subpages.show', $subpage->slug);
    }

   
}
