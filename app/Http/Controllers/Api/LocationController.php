<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:locations',
            'address' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'required|string',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
        ]);
        return Location::create($validated);
    }

    public function show(Location $location)
    {
        return $location;
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'sometimes|unique:locations,name,' . $location->id,
            'address' => 'nullable|string',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'category' => 'sometimes|string',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
        ]);
        $location->update($validated);
        return $location;
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
