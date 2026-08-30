<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    protected $fillable = [
        'name',
        'model',
        'code',
        'seat_rows',
        'seat_columns',
        'total_seats',
        'image',
        'status',
    ];

    /**
     * Flight schedules that use this airplane.
     */
    public function schedules()
    {
        return $this->hasMany(FlightSchedule::class);
    }

    /**
     * Build the full list of seat codes for this airplane, e.g.
     * ["1A","1B","1C","1D","1E","1F","2A", ...].
     * Columns are lettered A, B, C... and a visual aisle is placed
     * in the middle of the row on the frontend (not stored here).
     *
     * @return array<int, string>
     */
    public function seatMap(): array
    {
        $seats = [];
        $letters = range('A', 'Z');

        for ($row = 1; $row <= $this->seat_rows; $row++) {
            for ($col = 0; $col < $this->seat_columns; $col++) {
                $seats[] = $row . $letters[$col];
            }
        }

        return $seats;
    }
}
