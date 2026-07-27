<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonorDonation extends Model
{
    protected $fillable = [
        'donor_list_id',
        'amount',
        'donation_date',
        'note',
    ];

    public function donor()
    {
        return $this->belongsTo(DonorList::class, 'donor_list_id');
    }
}
