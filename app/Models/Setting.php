<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_email',
        'site_phone',
        'address',
        'footer_text',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'logo',
        'favicon',
    ];

    /**
     * Convenience accessor used across the app: Setting::current()
     * Returns the single settings row if the admin has configured one, or
     * null otherwise. We deliberately do NOT auto-create a default row
     * here — doing so as a side effect of a page view previously caused a
     * "default" row to be created before the admin ever saved anything,
     * which could silently shadow their real logo/favicon/contact info.
     * Views should fall back to sensible defaults via `??`/`?->` when this
     * is null.
     */
    public static function current(): ?self
    {
        return static::latest()->first();
    }
}
