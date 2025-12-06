<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;

class AdminController extends Controller
{
    public function pendingApprovals(Request $request)
    {
        try {
            $events = Event::where('status', 'pending_approval')->get();
            $announcements = Announcement::where('status', 'pending_approval')->get();

            return response()->json([
                'events' => $events,
                'announcements' => $announcements,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkConflicts(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'daily_times' => 'required|array',
        ]);

        $conflicts = [];
        $period = CarbonPeriod::create($validated['start_date'], $validated['end_date']);

        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');

            if (!isset($validated['daily_times'][$dateStr])) {
                continue;
            }

            [$newStart, $newEnd] = explode('-', $validated['daily_times'][$dateStr]);

            $existingEvents = Event::where('status', 'published')
                ->where('location_id', $validated['location_id'])
                ->whereDate('start_date', '<=', $dateStr)
                ->whereDate('end_date', '>=', $dateStr)
                ->get();

            foreach ($existingEvents as $existing) {
                $dailyTimes = is_string($existing->daily_times)
                    ? json_decode($existing->daily_times, true)
                    : $existing->daily_times;

                if (!isset($dailyTimes[$dateStr])) {
                    continue;
                }

                [$existStart, $existEnd] = explode('-', $dailyTimes[$dateStr]);

                if (!($newEnd <= $existStart || $newStart >= $existEnd)) {
                    $conflicts[] = [
                        'id' => $existing->id,
                        'title' => $existing->title,
                        'date' => $dateStr,
                        'time' => $dailyTimes[$dateStr],
                        'location' => $existing->location->name ?? 'Unknown',
                    ];
                }
            }
        }

        return response()->json([
            'has_conflicts' => count($conflicts) > 0,
            'conflicts' => $conflicts,
        ]);
    }

    public function approveEvent(Request $request, Event $event)
    {
        $conflicts = $this->checkEventConflicts($event);

        if ($conflicts['has_conflicts']) {
            return response()->json([
                'message' => 'Cannot approve - schedule conflicts detected',
                'conflicts' => $conflicts['conflicts']
            ], 422);
        }

        $event->update(['status' => 'published']);
        return response()->json(['message' => 'Approved']);
    }

    public function rejectEvent(Request $request, Event $event)
    {
        $event->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);
        return response()->json(['message' => 'Rejected']);
    }

    public function approveAnnouncement(Request $request, Announcement $announcement)
    {
        $announcement->update(['status' => 'published']);
        return response()->json(['message' => 'Approved']);
    }

    public function rejectAnnouncement(Request $request, Announcement $announcement)
    {
        $announcement->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);
        return response()->json(['message' => 'Rejected']);
    }

    public function dashboard()
    {
        return response()->json(['pending' => 0]);
    }

    private function checkEventConflicts(Event $event)
    {
        $conflicts = [];
        $dailyTimes = is_string($event->daily_times)
            ? json_decode($event->daily_times, true)
            : $event->daily_times;

        $period = CarbonPeriod::create($event->start_date, $event->end_date);

        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');

            if (!isset($dailyTimes[$dateStr])) {
                continue;
            }

            [$newStart, $newEnd] = explode('-', $dailyTimes[$dateStr]);

            $existingEvents = Event::where('status', 'published')
                ->where('location_id', $event->location_id)
                ->where('id', '!=', $event->id)
                ->whereDate('start_date', '<=', $dateStr)
                ->whereDate('end_date', '>=', $dateStr)
                ->get();

            foreach ($existingEvents as $existing) {
                $existDailyTimes = is_string($existing->daily_times)
                    ? json_decode($existing->daily_times, true)
                    : $existing->daily_times;

                if (!isset($existDailyTimes[$dateStr])) {
                    continue;
                }

                [$existStart, $existEnd] = explode('-', $existDailyTimes[$dateStr]);

                if (!($newEnd <= $existStart || $newStart >= $existEnd)) {
                    $conflicts[] = [
                        'id' => $existing->id,
                        'title' => $existing->title,
                        'date' => $dateStr,
                        'time' => $existDailyTimes[$dateStr],
                        'location' => $existing->location->name ?? 'Unknown',
                    ];
                }
            }
        }

        return [
            'has_conflicts' => count($conflicts) > 0,
            'conflicts' => $conflicts,
        ];
    }
}
