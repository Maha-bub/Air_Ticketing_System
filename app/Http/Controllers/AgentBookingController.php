<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FlightSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgentBookingController extends Controller
{
    /**
     * All currently scheduled, active flights with live seat availability —
     * this is the agent's "check available services" screen.
     */
    public function services(Request $request)
    {
        $query = FlightSchedule::with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
            ->where('status', 'scheduled')
            ->whereHas('route', fn($q) => $q->where('status', 'active'));

        if ($search = $request->query('q')) {
            $query->whereHas('route', function ($q) use ($search) {
                $q->whereHas('originAirport', fn($a) => $a->where('city', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%"))
                    ->orWhereHas('destinationAirport', fn($a) => $a->where('city', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%"));
            });
        }

        $flights = $query->orderBy('price')->get();

        return view('agent.services.index', [
            'flights' => $flights,
            'search' => $search ?? '',
        ]);
    }

    /**
     * Seat-selection + customer-details form for booking one flight.
     */
    public function create(FlightSchedule $flightSchedule)
    {
        $flightSchedule->load(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane']);

        abort_unless($flightSchedule->airplane, 404, 'No airplane assigned to this schedule yet.');

        $bookedSeats = $flightSchedule->bookedSeats();
        $allSeats = $flightSchedule->airplane->seatMap();

        return view('agent.services.create', [
            'schedule' => $flightSchedule,
            'seats' => $allSeats,
            'bookedSeats' => $bookedSeats,
        ]);
    }

    /**
     * Create the booking. If the customer's email doesn't match an existing
     * account, a new customer account is created on the spot with a random
     * password (shown once to the agent so they can relay it to the
     * passenger).
     */
    public function store(Request $request, FlightSchedule $flightSchedule)
    {
        $data = $request->validate([
            'customer_email' => 'required|email|max:150',
            'passenger_name' => 'required|string|max:150',
            'passenger_phone' => 'required|string|max:30',
            'seats' => 'required|array|min:1|max:9',
            'seats.*' => 'required|string',
            'payment_method' => 'required|in:cash_on_counter,bkash,card',
        ]);

        $flightSchedule->load('airplane');

        $alreadyBooked = $flightSchedule->bookedSeats();
        $clash = array_intersect($data['seats'], $alreadyBooked);

        if (!empty($clash)) {
            return back()->withInput()->with('error', 'Seat(s) ' . implode(', ', $clash) . ' were just booked. Please pick different seats.');
        }

        $generatedPassword = null;
        $customer = User::where('email', $data['customer_email'])->first();

        if (!$customer) {
            $generatedPassword = Str::random(8);

            $customer = User::create([
                'name' => $data['passenger_name'],
                'email' => $data['customer_email'],
                'password' => Hash::make($generatedPassword),
                'role' => 'customer',
            ]);
        }

        $seatCount = count($data['seats']);

        $booking = Booking::create([
            'pnr' => Booking::generatePnr(),
            'user_id' => $customer->id,
            'agent_id' => Auth::id(),
            'flight_schedule_id' => $flightSchedule->id,
            'passenger_name' => $data['passenger_name'],
            'passenger_email' => $data['customer_email'],
            'passenger_phone' => $data['passenger_phone'],
            'seats' => $data['seats'],
            'seat_count' => $seatCount,
            'unit_price' => $flightSchedule->price,
            'total_amount' => $flightSchedule->price * $seatCount,
            'status' => 'confirmed',
            'payment_method' => $data['payment_method'],
        ]);

        return redirect()->route('agent.bookings.show', $booking->id)
            ->with('success', 'Booking confirmed! PNR: ' . $booking->pnr)
            ->with('generated_password', $generatedPassword);
    }

    /**
     * Every booking this agent has personally created — their own "sales
     * history".
     */
    public function history()
    {
        $bookings = Booking::with(['flightSchedule.route.originAirport', 'flightSchedule.route.destinationAirport', 'user'])
            ->where('agent_id', Auth::id())
            ->latest()
            ->get();

        return view('agent.bookings.index', ['bookings' => $bookings]);
    }

    /**
     * Receipt-style detail view right after booking, or when revisiting from
     * history.
     */
    public function show(Booking $booking)
    {
        abort_unless($booking->agent_id === Auth::id(), 403);

        $booking->load(['flightSchedule.route.airline', 'flightSchedule.route.originAirport', 'flightSchedule.route.destinationAirport', 'flightSchedule.airplane', 'user']);

        return view('agent.bookings.show', [
            'booking' => $booking,
            'generatedPassword' => session('generated_password'),
        ]);
    }
}
