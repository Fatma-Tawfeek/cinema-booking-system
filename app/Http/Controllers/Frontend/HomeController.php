<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sliderMovies = Movie::with('categories')->where('status', 'showing_now')->inRandomOrder()->limit(3)->get();

        $filteredMovies = Movie::when($request->search, function ($q) use ($request) {
            return $q->where('title', 'LIKE', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {
            return $q->whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        })->when($request->date, function ($q) use ($request) {
            return $q->whereHas('schedules', function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            });
        })
            ->with('categories', 'schedules')
            ->limit(4)
            ->get();

        $categories = Category::all();

        $comingSoonMovies = Movie::where('status', 'upcoming')->limit(4)->get();

        if ($request->ajax()) {
            return view('frontend.filtered_movies', compact('filteredMovies'));
        }

        return view('frontend.index', compact('sliderMovies', 'filteredMovies', 'categories', 'comingSoonMovies'));
    }
}
