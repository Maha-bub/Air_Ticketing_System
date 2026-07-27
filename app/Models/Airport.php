<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = [
        'name',
        'code',
        'city',
        'country',
        'status',
    ];

    /**
     * Routes that depart from this airport.
     */
    public function departingRoutes()
    {
        return $this->hasMany(FlightRoute::class, 'origin_airport_id');
    }

    /**
     * Routes that arrive at this airport.
     */
    public function arrivingRoutes()
    {
        return $this->hasMany(FlightRoute::class, 'destination_airport_id');
    }
}
