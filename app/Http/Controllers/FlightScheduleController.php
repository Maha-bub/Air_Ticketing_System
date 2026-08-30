<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use App\Models\FlightRoute;
use App\Models\FlightSchedule;
use Illuminate\Http\Request;

class FlightScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = FlightSchedule::with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
            ->latest()
            ->get();

        return view('admin.flight-schedules.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = FlightRoute::with(['airline', 'originAirport', 'destinationAirport'])->get();
        $airplanes = Airplane::where('status', 'active')->get();

        return view('admin.flight-schedules.create', compact('routes', 'airplanes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'airplane_id' => 'nullable|exists:airplanes,id',
            'flight_number' => 'required|string|max:20',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'days_of_operation' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,delayed,cancelled',
        ]);

        FlightSchedule::create($request->only([
            'route_id',
            'airplane_id',
            'flight_number',
            'departure_time',
            'arrival_time',
            'days_of_operation',
            'price',
            'status',
        ]));

        return redirect()->route('admin.flight-schedules.index')->with('success', 'Flight schedule created successfully!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FlightSchedule $flight_schedule)
    {
        $routes = FlightRoute::with(['airline', 'originAirport', 'destinationAirport'])->get();
        $airplanes = Airplane::where('status', 'active')->get();

        return view('admin.flight-schedules.edit', ['schedule' => $flight_schedule, 'routes' => $routes, 'airplanes' => $airplanes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlightSchedule $flight_schedule)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'airplane_id' => 'nullable|exists:airplanes,id',
            'flight_number' => 'required|string|max:20',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'days_of_operation' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,delayed,cancelled',
        ]);

        $flight_schedule->update($request->only([
            'route_id',
            'airplane_id',
            'flight_number',
            'departure_time',
            'arrival_time',
            'days_of_operation',
            'price',
            'status',
        ]));

        return redirect()->route('admin.flight-schedules.index')->with('success', 'Flight schedule updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlightSchedule $flight_schedule)
    {
        $flight_schedule->delete();

        return redirect()->route('admin.flight-schedules.index')->with('success', 'Flight schedule deleted successfully!!');
    }
}
