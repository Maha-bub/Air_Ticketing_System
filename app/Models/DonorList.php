<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonorList extends Model
{
    protected $fillable = ['name','image','email','phone','total'];

    /**
     * Individual donation history entries for this donor.
     */
    public function donations()
    {
        return $this->hasMany(DonorDonation::class)->orderByDesc('donation_date');
    }
}
