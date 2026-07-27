<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Airport::withCount(['departingRoutes', 'arrivingRoutes'])->latest()->get();

        return view('admin.airports.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.airports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'code' => 'required|string|max:10|unique:airports,code',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        Airport::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'city' => $request->city,
            'country' => $request->country,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.airports.index')->with('success', 'Airport created successfully!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport)
    {
        return view('admin.airports.edit', compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'code' => 'required|string|max:10|unique:airports,code,' . $airport->id,
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $airport->update([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'city' => $request->city,
            'country' => $request->country,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.airports.index')->with('success', 'Airport updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport)
    {
        if ($airport->departingRoutes()->exists() || $airport->arrivingRoutes()->exists()) {
            return redirect()->route('admin.airports.index')
                ->with('error', 'This airport is used by one or more routes and cannot be deleted. Remove those routes first.');
        }

        $airport->delete();

        return redirect()->route('admin.airports.index')->with('success', 'Airport deleted successfully!!');
    }
}
