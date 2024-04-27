<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cinemas = Cinema::paginate(15);
        return view('admin.cinemas.index', compact('cinemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cinemas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'num_of_rows' => 'required|integer|min:1|max:1000',
            'num_of_columns' => 'required|integer|min:1|max:1000',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/cinemas', 'public');
        }

        $cinema = Cinema::create([
            'name' => $request->name,
            'rows_number' => $request->num_of_rows,
            'seat_number' => $request->num_of_columns,
            'logo_img' => $path ?? 'images/cinemas/default.png',
        ]);

        // bulk insert into seats table with cinema id
        $num_of_seats = $request->num_of_rows * $request->num_of_columns;
        for ($i = 0; $i < $num_of_seats; $i++) {
            Seat::create([
                'cinema_id' => $cinema->id,
                'type' => 'regular'
            ]);
        }

        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cinema $cinema)
    {
        return view('admin.cinemas.edit', compact('cinema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cinema $cinema)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'num_of_rows' => 'required|integer|min:1|max:1000',
            'num_of_columns' => 'required|integer|min:1|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/cinemas', 'public');
        }

        // bulk insert into seats table with cinema id
        if ($request->num_of_rows != $cinema->rows_number || $request->num_of_columns != $cinema->seat_number) {
            Seat::where('cinema_id', $cinema->id)->delete();
            $num_of_seats = $request->num_of_rows * $request->num_of_columns;
            for ($i = 0; $i < $num_of_seats; $i++) {
                Seat::create([
                    'cinema_id' => $cinema->id,
                    'type' => 'regular'
                ]);
            }
        }

        $cinema->update([
            'name' => $request->name,
            'rows_number' => $request->num_of_rows,
            'seat_number' => $request->num_of_columns,
            'logo_img' => $path ?? $cinema->logo_img,
        ]);

        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema)
    {
        $cinema->seats()->delete();
        $cinema->delete();
        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema deleted successfully.');
    }
}
