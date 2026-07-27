<?php

namespace App\Models;

use App\Models\Donations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignList extends Model
{
    use SoftDeletes;

    public const STATUS_DRAFT = 'Draft';
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_CLOSED = 'Closed';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_ACTIVE,
        self::STATUS_COMPLETED,
        self::STATUS_CLOSED,
    ];

    protected $fillable = [
        'image',
        'name',
        'description',
        'category_id',
        'goal_amount',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // ----------------------------------------------------------------
    // Relationships
    // ----------------------------------------------------------------

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function donations()
    {
        return $this->hasMany(Donations::class, 'campaign_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ----------------------------------------------------------------
    // Computed attributes
    // ----------------------------------------------------------------

    /**
     * Raised amount is never typed in by an admin — it is always derived
     * from the donations linked to this campaign. When the caller has
     * already eager-loaded the sum (withSum('donations', 'amount')) we
     * reuse it to avoid an extra query.
     */
    public function getRaisedAmountAttribute(): float
    {
        if (array_key_exists('donations_sum_amount', $this->attributes)) {
            return (float) $this->attributes['donations_sum_amount'];
        }

        return (float) $this->donations()->sum('amount');
    }

    public function getDonationsCountAttribute(): int
    {
        if (array_key_exists('donations_count', $this->attributes)) {
            return (int) $this->attributes['donations_count'];
        }

        return $this->donations()->count();
    }

    public function getProgressAttribute(): int
    {
        $goal = (float) $this->goal_amount;

        if ($goal <= 0) {
            return 0;
        }

        return (int) min(100, round(($this->raised_amount / $goal) * 100));
    }

    public function getIsGoalReachedAttribute(): bool
    {
        return (float) $this->goal_amount > 0 && $this->raised_amount >= (float) $this->goal_amount;
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_ACTIVE => 'bg-success',
            self::STATUS_COMPLETED => 'bg-primary',
            self::STATUS_CLOSED => 'bg-danger',
            default => 'bg-secondary', // Draft
        };
    }

    /**
     * Move a campaign from Active -> Completed automatically once its goal
     * has been reached. Admin can still close a campaign manually at any
     * point in the flow (Draft -> Active -> Completed -> Closed).
     */
    public function refreshStatus(): void
    {
        if ($this->status === self::STATUS_ACTIVE && $this->is_goal_reached) {
            $this->forceFill(['status' => self::STATUS_COMPLETED])->save();
        }
    }

    // ----------------------------------------------------------------
    // Query scopes (used by the admin Search / Filter / Sort UI)
    // ----------------------------------------------------------------

    public function scopeSearchTitle(Builder $query, ?string $term): Builder
    {
        return $term
            ? $query->where('name', 'like', '%' . $term . '%')
            : $query;
    }

    public function scopeOfCategory(Builder $query, $categoryId): Builder
    {
        return $categoryId
            ? $query->where('category_id', $categoryId)
            : $query;
    }

    public function scopeOfStatus(Builder $query, ?string $status): Builder
    {
        return $status
            ? $query->where('status', $status)
            : $query;
    }

    public function scopeEndingBetween(Builder $query, ?string $from, ?string $to): Builder
    {
        if ($from) {
            $query->whereDate('end_date', '>=', $from);
        }

        if ($to) {
            $query->whereDate('end_date', '<=', $to);
        }

        return $query;
    }
}
