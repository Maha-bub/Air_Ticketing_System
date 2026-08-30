<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\FlightSchedule;
use Illuminate\Support\Facades\Auth;

class BookingCheckoutService
{
    public function create(array $data, FlightSchedule $schedule, array $cart, array $paymentMeta = []): ?Booking
    {
        $alreadyBooked = $schedule->bookedSeats();
        $clash = array_intersect($cart['seats'], $alreadyBooked);

        if (! empty($clash)) {
            return null;
        }

        $seatCount = count($cart['seats']);

        return Booking::create([
            'pnr' => Booking::generatePnr(),
            'user_id' => Auth::id(),
            'flight_schedule_id' => $schedule->id,
            'passenger_name' => $data['passenger_name'],
            'passenger_email' => $data['passenger_email'],
            'passenger_phone' => $data['passenger_phone'],
            'seats' => $cart['seats'],
            'seat_count' => $seatCount,
            'unit_price' => $cart['unit_price'],
            'total_amount' => $cart['unit_price'] * $seatCount,
            'status' => 'confirmed',
            'payment_method' => $data['payment_method'],
            'payment_status' => $paymentMeta['payment_status'] ?? 'pay_at_counter',
            'payment_reference' => $paymentMeta['payment_reference'] ?? null,
            'payment_transaction_id' => $paymentMeta['payment_transaction_id'] ?? null,
        ]);
    }
}
