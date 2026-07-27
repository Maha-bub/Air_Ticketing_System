<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightRoute extends Model
{
    // The table is named "routes"; the class is named FlightRoute to avoid
    // clashing with Illuminate\Support\Facades\Route.
    protected $table = 'routes';

    protected $fillable = [
        'airline_id',
        'origin_airport_id',
        'destination_airport_id',
        'distance_km',
        'duration_minutes',
        'status',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function schedules()
    {
        return $this->hasMany(FlightSchedule::class, 'route_id');
    }
}
