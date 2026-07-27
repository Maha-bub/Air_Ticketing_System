<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = [
        'name',
        'code',
        'country',
        'logo',
        'status',
    ];

    /**
     * Routes operated by this airline.
     */
    public function routes()
    {
        return $this->hasMany(FlightRoute::class);
    }
}
