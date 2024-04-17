<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::paginate(15);
        return view('admin.actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.actors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/actors', 'public');
        }

        Actor::create([
            'name' => $request->name,
            'nationality' => $request->nationality,
            'profile_img' => $path ?? 'default.png',
        ]);

        return redirect()->route('admin.actors.index')->with('success', 'Actor created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        return view('admin.actors.edit', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            @unlink('storage/' . $actor->profile_img);
            $path = $request->file('image')->store('images/actors', 'public');
        }

        $actor->update([
            'name' => $request->name,
            'nationality' => $request->nationality,
            'profile_img' => $path ?? $actor->profile_img,
        ]);

        return redirect()->back()->with('success', 'Actor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        $actor->movies()->detach();
        $actor->delete();
        @unlink('storage/' . $actor->profile_img);
        return redirect()->route('admin.actors.index')->with('success', 'Actor deleted successfully');
    }
}
