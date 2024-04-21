<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\CinemaMoviesSchedule;
use App\Models\CinemaTimeslot;
use App\Models\Movie;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = CinemaMoviesSchedule::with('movie', 'cinema', 'timeslot')->paginate(15);
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cinemas = Cinema::all();
        $movies = Movie::all();
        $timeslots = CinemaTimeslot::all();
        return view('admin.schedules.create', compact('cinemas', 'movies', 'timeslots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'cinema_id' => 'required|integer|exists:cinemas,id',
            'timeslot_id' => 'required|integer|exists:cinema_timeslots,id',
            'date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        CinemaMoviesSchedule::create([
            'movie_id' => $request->movie_id,
            'cinema_id' => $request->cinema_id,
            'cinema_timeslot_id' => $request->timeslot_id,
            'date' => $request->date,
            'ticket_price' => $request->price
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CinemaMoviesSchedule $schedule)
    {
        $cinemas = Cinema::all();
        $movies = Movie::all();
        $timeslots = CinemaTimeslot::all();
        return view('admin.schedules.edit', compact('schedule', 'cinemas', 'movies', 'timeslots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CinemaMoviesSchedule $schedule)
    {
        $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'cinema_id' => 'required|integer|exists:cinemas,id',
            'timeslot_id' => 'required|integer|exists:cinema_timeslots,id',
            'date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $schedule->update([
            'movie_id' => $request->movie_id,
            'cinema_id' => $request->cinema_id,
            'cinema_timeslot_id' => $request->timeslot_id,
            'date' => $request->date,
            'ticket_price' => $request->price
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CinemaMoviesSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully');
    }

    public function timeslots(Cinema $cinema)
    {
        $timeslots = CinemaTimeslot::where('cinema_id', $cinema->id)->select('from', 'to', 'id')->get();
        return response()->json($timeslots);
    }
}
