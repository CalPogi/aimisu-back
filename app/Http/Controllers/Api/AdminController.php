<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function pendingApprovals(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $events = Event::where('status', 'pending_approval')
            ->with('organization', 'createdBy')
            ->orderBy('created_at', 'desc')
            ->get();

        $announcements = Announcement::where('status', 'pending_approval')
            ->with('organization', 'createdBy')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'events' => $events,
            'announcements' => $announcements,
        ]);
    }

    public function approveEvent(Request $request, Event $event)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($event->status !== 'pending_approval') {
            return response()->json(['message' => 'Event is not pending approval'], 400);
        }

        $event->update(['status' => 'published', 'published_at' => now()]);
        return response()->json([
            'message' => 'Event approved successfully',
            'event' => $event->load('organization', 'createdBy'),
        ]);
    }

    public function rejectEvent(Request $request, Event $event)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($event->status !== 'pending_approval') {
            return response()->json(['message' => 'Event is not pending approval'], 400);
        }

        $validated = $request->validate(['rejection_reason' => 'required|string|min:5']);

        $event->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return response()->json([
            'message' => 'Event rejected successfully',
            'event' => $event->load('organization', 'createdBy'),
        ]);
    }

    public function approveAnnouncement(Request $request, Announcement $announcement)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($announcement->status !== 'pending_approval') {
            return response()->json(['message' => 'Announcement is not pending approval'], 400);
        }

        $announcement->update(['status' => 'published', 'published_at' => now()]);
        return response()->json([
            'message' => 'Announcement approved successfully',
            'announcement' => $announcement->load('organization', 'createdBy'),
        ]);
    }

    public function rejectAnnouncement(Request $request, Announcement $announcement)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($announcement->status !== 'pending_approval') {
            return response()->json(['message' => 'Announcement is not pending approval'], 400);
        }

        $validated = $request->validate(['rejection_reason' => 'required|string|min:5']);

        $announcement->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return response()->json([
            'message' => 'Announcement rejected successfully',
            'announcement' => $announcement->load('organization', 'createdBy'),
        ]);
    }

    public function dashboard()
    {
        return response()->json([
            'total_events' => Event::where('status', 'published')->count(),
            'total_announcements' => Announcement::where('status', 'published')->count(),
            'pending' => Event::where('status', 'pending_approval')->count() + Announcement::where('status', 'pending_approval')->count(),
        ]);
    }
}
