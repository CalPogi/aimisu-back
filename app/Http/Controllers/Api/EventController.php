<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'daily_times' => 'required|array|min:1', // { "2025-12-01": "09:00-17:00", ... }
            'daily_times.*' => 'required|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/', // "09:00-17:00"
            'location_id' => 'nullable|exists:locations,id',
            'organization_id' => 'required|exists:organizations,id',
            'visibility_scope' => 'required|string',
            'visible_departments' => 'nullable|array',
        ]);

        $validated['created_by'] = $request->user()->id;
        $validated['status'] = 'pending_approval';
        $validated['visible_departments'] = json_encode($validated['visible_departments'] ?? []);
        $validated['daily_times'] = json_encode($validated['daily_times']);

        $event = Event::create($validated);
        return response()->json(['message' => 'Event created', 'event' => $event], 201);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'daily_times' => 'required|array|min:1',
            'daily_times.*' => 'required|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'location_id' => 'nullable|exists:locations,id',
            'organization_id' => 'required|exists:organizations,id',
            'visibility_scope' => 'required|string',
            'visible_departments' => 'nullable|array',
        ]);

        $validated['visible_departments'] = json_encode($validated['visible_departments'] ?? []);
        $validated['daily_times'] = json_encode($validated['daily_times']);
        $event->update($validated);

        return response()->json(['message' => 'Event updated', 'event' => $event]);
    }

    public function index()
    {
        return Event::where('status', 'published')->latest('start_date')->get();
    }

    public function mySubmissions(Request $request)
    {
        return Event::where('created_by', $request->user()->id)->latest('created_at')->get();
    }
}
