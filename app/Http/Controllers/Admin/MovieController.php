<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(15);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $actors = Actor::all();
        return view('admin.movies.create', compact('categories', 'actors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:categories,id',
            'release_date' => 'required|date',
            'duration' => 'required|integer|min:30|max:240',
            'actor_id' => 'required|array',
            'actor_id.*' => 'required|integer|exists:actors,id',
            'description' => 'required|string',
            'status' => 'required|in:showing_now,upcoming',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/movies', 'public');
        }

        $movie = Movie::create([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'duration' => $request->duration,
            'description' => $request->description,
            'status' => $request->status,
            'poster_img' => $path ?? 'images/movies/default.png',
        ]);

        $movie->categories()->attach($request->category_id);

        $movie->actors()->attach($request->actor_id);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $categories = Category::all();
        $actors = Actor::all();
        return view('admin.movies.edit', compact('movie', 'categories', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:categories,id',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
            'actor_id' => 'required|array',
            'actor_id.*' => 'required|integer|exists:actors,id',
            'description' => 'required|string',
            'status' => 'required|in:showing_now,upcoming',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            @unlink('storage/' . $movie->poster_img);
            $path = $request->file('image')->store('images/movies', 'public');
        }

        $movie->update([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'duration' => $request->duration,
            'description' => $request->description,
            'status' => $request->status,
            'poster_img' => $path ?? $movie->poster_img,
        ]);

        $movie->categories()->sync($request->category_id);
        $movie->actors()->sync($request->actor_id);

        return redirect()->back()->with('success', 'Movie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->categories()->detach();
        $movie->actors()->detach();
        $movie->delete();
        @unlink('storage/' . $movie->poster_img);
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully');
    }
}
