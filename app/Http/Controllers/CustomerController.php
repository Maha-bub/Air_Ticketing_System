<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $bookings = $this->userBookings($user->id)->take(5)->get();
        $allBookings = $this->userBookings($user->id)->get();

        $stats = [
            'total_bookings' => $allBookings->count(),
            'upcoming' => $allBookings->where('status', 'confirmed')->count(),
            'cancelled' => $allBookings->where('status', 'cancelled')->count(),
            'total_spent' => $allBookings->where('status', '!=', 'cancelled')->sum('total_amount'),
        ];

        return view('customer.dashboard', [
            'user' => $user,
            'bookings' => $bookings,
            'stats' => $stats,
        ]);
    }

    /**
     * "Previous Trips" — the customer's complete booking history.
     */
    public function bookings()
    {
        $user = Auth::user();

        $bookings = $this->userBookings($user->id)->get();

        return view('customer.bookings.index', [
            'user' => $user,
            'bookings' => $bookings,
        ]);
    }

    private function userBookings(int $userId)
    {
        return Booking::with(['flightSchedule.route.airline', 'flightSchedule.route.originAirport', 'flightSchedule.route.destinationAirport', 'flightSchedule.airplane'])
            ->where('user_id', $userId)
            ->latest();
    }
}
