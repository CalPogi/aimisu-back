<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Optionally, add filtering, searching, pagination
        $query = Event::query();

        // Example: filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Example: filter by organizer
        if ($request->filled('organizer_id')) {
            $query->where('organizer_id', $request->organizer_id);
        }

        // Pagination (default 10 per page)
        $events = $query->orderByDesc('start_date')->paginate($request->get('per_page', 10));

        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user(); // Assumes you're using Laravel authentication

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'time_slots' => 'required|array',
            'location' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            // Optionally validate each time slot in array:
            'time_slots.*.date' => 'required|date',
            'time_slots.*.start' => 'required|string',
        ]);

        // Set status depending on role
        $status = ($user->role === 'Admin') ? 'Approved' : 'Pending';

        $event = Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'time_slots' => $validated['time_slots'],
            'location' => $validated['location'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'organizer_id' => $user->id,
            'status' => $status,
        ]);

        // Optionally: trigger approval workflow, notifications, etc. for 'Pending'
        // Approval steps here...

        return response()->json($event, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Permission check here for editing (Admin or event organizer etc.)

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'time_slots' => 'sometimes|array',
            'location' => 'sometimes|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'sometimes|in:Pending,Approved,Rejected,Cancelled', // status can be changed if allowed
        ]);

        $event->update($validated);

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Permission check here (Admin or event creator)
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
