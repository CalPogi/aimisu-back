<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'category',
        'start_date', 'end_date', 'daily_times',
        'location_id', 'department_id', 'organization_id', 'created_by',
        'status', 'rejection_reason',
        'visibility_scope', 'visible_departments',
        'published_at',
    ];

    protected $casts = [
        'daily_times' => 'json',
        'visible_departments' => 'json',
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'datetime',
    ];

    protected $with = ['organization', 'createdBy', 'location'];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    // Get start datetime for a specific date
    public function getStartDateTime($date)
    {
        $dateStr = $date->format('Y-m-d');
        if (isset($this->daily_times[$dateStr])) {
            [$start, $end] = explode('-', $this->daily_times[$dateStr]);
            return $date->format('Y-m-d') . ' ' . $start;
        }
        return null;
    }

    // Get end datetime for a specific date
    public function getEndDateTime($date)
    {
        $dateStr = $date->format('Y-m-d');
        if (isset($this->daily_times[$dateStr])) {
            [$start, $end] = explode('-', $this->daily_times[$dateStr]);
            return $date->format('Y-m-d') . ' ' . $end;
        }
        return null;
    }
}
