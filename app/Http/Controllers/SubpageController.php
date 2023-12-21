<?php

namespace App\Http\Controllers;

use App\Models\Subpage;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSubpageRequest;

class SubpageController extends Controller
{
    // Display a list of all subpages
    public function index()
    {
        $subpages = Subpage::all();
        return view('subpages.index', compact('subpages'));
    }

    // Show the form for creating a new subpage
    public function create()
    {
        return view('subpages.create');
    }

    // Store a newly created subpage
    public function store(CreateSubpageRequest $request) // Using custom request for validation
    {
        $subpage = Subpage::create($request->all());
        return redirect()->route('subpages.show', $subpage);
    }

    // Display the specified subpage
    public function show(Subpage $subpage)
    {
        return view('subpages.show', compact('subpage'));
    }
}
