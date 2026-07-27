<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'task',
        'status',
        'joining_date',
        'image',
    ];

    /**
     * The user account (login credentials) linked to this volunteer profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
