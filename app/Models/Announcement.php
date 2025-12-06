<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'content', 'organization_id', 'created_by', 'status',
        'rejection_reason',
        'visibility_scope', 'visible_departments',
        'published_at'
    ];

    protected $casts = [
        'visible_departments' => 'json',
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
