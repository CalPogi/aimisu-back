<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = ['name', 'address', 'latitude', 'longitude', 'category', 'capacity', 'description', 'amenities', 'status'];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'amenities' => 'json',
        'status' => 'string',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function analytics(): HasMany
    {
        return $this->hasMany(Analytic::class);
    }
}
