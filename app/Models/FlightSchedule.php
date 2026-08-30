<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightSchedule extends Model
{
    protected $fillable = [
        'route_id',
        'airplane_id',
        'flight_number',
        'departure_time',
        'arrival_time',
        'days_of_operation',
        'price',
        'status',
    ];

    public function route()
    {
        return $this->belongsTo(FlightRoute::class, 'route_id');
    }

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Flat list of every seat code already taken by a non-cancelled booking.
     *
     * @return array<int, string>
     */
    public function bookedSeats(): array
    {
        return $this->bookings()
            ->where('status', '!=', 'cancelled')
            ->pluck('seats')
            ->flatten()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * How many seats are still free on this schedule's airplane.
     */
    public function availableSeatsCount(): int
    {
        $total = $this->airplane->total_seats ?? 0;

        return max(0, $total - count($this->bookedSeats()));
    }

    /**
     * Shape this schedule into a flat array that is easy for any frontend
     * (customer site, agent panel, admin panel) to render without needing
     * to know Eloquent relation names.
     */
    public function toCard(): array
    {
        $route = $this->route;

        return [
            'id' => $this->id,
            'flight_number' => $this->flight_number,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'days_of_operation' => $this->days_of_operation,
            'price' => (float) $this->price,
            'status' => $this->status,
            'airline' => $route?->airline?->name,
            'airline_logo' => $route?->airline?->logo ? asset('storage/' . $route->airline->logo) : null,
            'origin' => [
                'city' => $route?->originAirport?->city,
                'code' => $route?->originAirport?->code,
                'name' => $route?->originAirport?->name,
            ],
            'destination' => [
                'city' => $route?->destinationAirport?->city,
                'code' => $route?->destinationAirport?->code,
                'name' => $route?->destinationAirport?->name,
            ],
            'duration_minutes' => $route?->duration_minutes,
            'airplane' => $this->airplane?->name,
            'available_seats' => $this->airplane ? $this->availableSeatsCount() : null,
            'total_seats' => $this->airplane?->total_seats,
        ];
    }
}
