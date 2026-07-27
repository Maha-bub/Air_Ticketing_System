<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\FlightRoute;
use App\Models\FlightSchedule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAirports = Airport::count();
        $totalAirlines = Airline::count();
        $totalRoutes = FlightRoute::count();
        $totalFlightSchedules = FlightSchedule::count();
        $scheduledFlights = FlightSchedule::where('status', 'scheduled')->count();
        $delayedFlights = FlightSchedule::where('status', 'delayed')->count();
        $cancelledFlights = FlightSchedule::where('status', 'cancelled')->count();

        $recentSchedules = FlightSchedule::with(['route.airline', 'route.originAirport', 'route.destinationAirport'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAirports',
            'totalAirlines',
            'totalRoutes',
            'totalFlightSchedules',
            'scheduledFlights',
            'delayedFlights',
            'cancelledFlights',
            'recentSchedules'
        ));
    }
}
