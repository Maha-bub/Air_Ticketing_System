<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightSchedule extends Model
{
    protected $fillable = [
        'route_id',
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
}
