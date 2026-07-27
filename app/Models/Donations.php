<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CampaignList;


class Donations extends Model
{
    protected $fillable = ['name', 'campaign_id', 'amount', 'payment_method'];

    public function campaign()
    {
        return $this->belongsTo(CampaignList::class, 'campaign_id');
    }

    protected static function booted()
    {
        // Raised Amount on a campaign is always derived from its donations
        // (see CampaignList::getRaisedAmountAttribute). Whenever a donation
        // is recorded, check whether the campaign's goal has now been
        // reached so its status can move Active -> Completed automatically.
        static::created(function (Donations $donation) {
            $donation->campaign?->refreshStatus();
        });
    }
}
