<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'time_slots',
        'location',
        'latitude',
        'longitude',
        'organizer_id',
        'status'
    ];

    protected $casts = [
        'time_slots' => 'array',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
