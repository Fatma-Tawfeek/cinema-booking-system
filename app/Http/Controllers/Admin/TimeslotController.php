<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Models\CinemaTimeslot;
use App\Http\Controllers\Controller;

class TimeslotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timeslots = CinemaTimeslot::with('cinema')->paginate(15);
        return view('admin.timeslots.index', compact('timeslots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cinemas = Cinema::all();
        return view('admin.timeslots.create', compact('cinemas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cinema_id' => 'required|integer|exists:cinemas,id',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i|after:from',
        ]);

        CinemaTimeslot::create([
            'cinema_id' => $request->cinema_id,
            'day' => $request->day,
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return redirect()->route('admin.timeslots.index')->with('success', 'Cinema timeslot created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CinemaTimeslot $timeslot)
    {
        $cinemas = Cinema::all();
        return view('admin.timeslots.edit', compact('timeslot', 'cinemas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CinemaTimeslot $timeslot)
    {
        $request->validate([
            'cinema_id' => 'required|integer|exists:cinemas,id',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'from' => 'required',
            'to' => 'required|after:from',
        ]);

        $timeslot->update([
            'cinema_id' => $request->cinema_id,
            'day' => $request->day,
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return redirect()->back()->with('success', 'Cinema timeslot updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CinemaTimeslot $timeslot)
    {
        $timeslot->delete();
        return redirect()->back()->with('success', 'Cinema timeslot deleted successfully.');
    }
}
