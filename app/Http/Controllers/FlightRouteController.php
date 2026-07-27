<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\FlightRoute;
use Illuminate\Http\Request;

class FlightRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = FlightRoute::with(['airline', 'originAirport', 'destinationAirport'])
            ->withCount('schedules')
            ->latest()
            ->get();

        return view('admin.routes.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $airlines = Airline::orderBy('name')->get();
        $airports = Airport::orderBy('name')->get();

        return view('admin.routes.create', compact('airlines', 'airports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'origin_airport_id' => 'required|exists:airports,id|different:destination_airport_id',
            'destination_airport_id' => 'required|exists:airports,id',
            'distance_km' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        FlightRoute::create($request->only([
            'airline_id',
            'origin_airport_id',
            'destination_airport_id',
            'distance_km',
            'duration_minutes',
            'status',
        ]));

        return redirect()->route('admin.routes.index')->with('success', 'Route created successfully!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FlightRoute $route)
    {
        $airlines = Airline::orderBy('name')->get();
        $airports = Airport::orderBy('name')->get();

        return view('admin.routes.edit', compact('route', 'airlines', 'airports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlightRoute $route)
    {
        $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'origin_airport_id' => 'required|exists:airports,id|different:destination_airport_id',
            'destination_airport_id' => 'required|exists:airports,id',
            'distance_km' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $route->update($request->only([
            'airline_id',
            'origin_airport_id',
            'destination_airport_id',
            'distance_km',
            'duration_minutes',
            'status',
        ]));

        return redirect()->route('admin.routes.index')->with('success', 'Route updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlightRoute $route)
    {
        if ($route->schedules()->exists()) {
            return redirect()->route('admin.routes.index')
                ->with('error', 'This route has flight schedules attached and cannot be deleted. Remove those schedules first.');
        }

        $route->delete();

        return redirect()->route('admin.routes.index')->with('success', 'Route deleted successfully!!');
    }
}
