<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'start_date',
        'end_date',
        'location_id',
        'location_name',
        'latitude',
        'longitude',
        'department_id',
        'organization_id',
        'created_by',
        'status',
        'rejection_reason',
        'memo_url',
        'visibility_scope',
        'visible_departments',
        'daily_times',
        'published_at',
        'views_count',
        'registration_count',
    ];

    protected $casts = [
        'visible_departments' => 'json',
        'daily_times' => 'json',
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'datetime',
    ];

    protected $with = ['organization', 'createdBy'];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
