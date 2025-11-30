<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::where('status', 'published')->with('organization', 'createdBy')->orderBy('start_date', 'asc')->get();
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user->organization_id) {
            return response()->json(['message' => 'Must belong to organization'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:academic,sports,cultural,social,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location_id' => 'nullable|exists:locations,id',
            'location_name' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'visibility_scope' => 'required|in:campus_wide,specific_departments',
            'visible_departments' => 'nullable|array',
            'daily_times' => 'nullable|array',
            'status' => 'sometimes|in:draft,pending_approval',
        ]);

        // If location_id provided, fetch and store location details
        if (!empty($validated['location_id'])) {
            $loc = Location::find($validated['location_id']);
            if ($loc) {
                $validated['location_name'] = $loc->name;
                $validated['latitude'] = $loc->latitude;
                $validated['longitude'] = $loc->longitude;
            }
        }

        // Remove location_id - we only store location details, not the ID
        unset($validated['location_id']);

        $validated['organization_id'] = $user->organization_id;
        $validated['created_by'] = $user->id;
        $validated['status'] = $request->input('status', 'draft');

        if ($validated['visibility_scope'] === 'specific_departments' && empty($validated['visible_departments'])) {
            $validated['visible_departments'] = $user->department_id ? [$user->department_id] : [];
        }

        $event = Event::create($validated);
        return response()->json($event->load('organization', 'createdBy'), 201);
    }

    public function show(Event $event)
    {
        if ($event->status !== 'published' && $event->created_by !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $event->load('organization', 'createdBy');
    }

    public function update(Request $request, Event $event)
    {
        if ($event->created_by !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!in_array($event->status, ['draft', 'rejected'])) {
            return response()->json(['message' => 'Can only edit draft or rejected events'], 400);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'category' => 'sometimes|in:academic,sports,cultural,social,other',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'location_id' => 'nullable|exists:locations,id',
            'location_name' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'visibility_scope' => 'sometimes|in:campus_wide,specific_departments',
            'visible_departments' => 'nullable|array',
        ]);

        if (!empty($validated['location_id'])) {
            $loc = Location::find($validated['location_id']);
            if ($loc) {
                $validated['location_name'] = $loc->name;
                $validated['latitude'] = $loc->latitude;
                $validated['longitude'] = $loc->longitude;
            }
        }

        unset($validated['location_id']);
        $event->update($validated);
        return response()->json($event->load('organization', 'createdBy'));
    }

    public function destroy(Request $request, Event $event)
    {
        if ($event->created_by !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($event->status !== 'draft') {
            return response()->json(['message' => 'Can only delete draft events'], 400);
        }

        $event->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function mySubmissions(Request $request)
    {
        return Event::where('created_by', $request->user()->id)->with('organization', 'createdBy')->orderBy('created_at', 'desc')->get();
    }
}
