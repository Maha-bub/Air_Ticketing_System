<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'pnr',
        'user_id',
        'agent_id',
        'flight_schedule_id',
        'passenger_name',
        'passenger_email',
        'passenger_phone',
        'seats',
        'seat_count',
        'unit_price',
        'total_amount',
        'status',
        'payment_method',
    ];

    protected $casts = [
        'seats' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The agent who created this booking on the customer's behalf, if any.
     * Null means the customer booked it themselves online.
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function flightSchedule()
    {
        return $this->belongsTo(FlightSchedule::class);
    }

    /**
     * Generate a short, human-friendly, unique booking reference.
     */
    public static function generatePnr(): string
    {
        do {
            $pnr = strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6));
        } while (static::where('pnr', $pnr)->exists());

        return $pnr;
    }

    /**
     * Flat array shape used by every booking-related frontend page
     * (confirmation, PDF ticket, customer history, agent history).
     */
    public function toTicketArray(): array
    {
        return [
            'id' => $this->id,
            'pnr' => $this->pnr,
            'passenger_name' => $this->passenger_name,
            'passenger_email' => $this->passenger_email,
            'passenger_phone' => $this->passenger_phone,
            'seats' => $this->seats,
            'seat_count' => $this->seat_count,
            'unit_price' => (float) $this->unit_price,
            'total_amount' => (float) $this->total_amount,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'booked_at' => $this->created_at->format('d M Y, h:i A'),
            'booked_by_agent' => $this->agent?->name,
            'schedule' => $this->flightSchedule?->toCard(),
        ];
    }
}
