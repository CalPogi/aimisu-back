<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return Announcement::where('status', 'published')
            ->with('organization', 'createdBy')
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user->organization_id) {
            return response()->json(['message' => 'Must belong to organization'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'visibility_scope' => 'required|in:campus_wide,organization_only,departments,specific_departments',
            'visible_departments' => 'nullable|array',
            'status' => 'sometimes|in:draft,pending_approval',
        ]);

        $validated['organization_id'] = $user->organization_id;
        $validated['created_by'] = $user->id;
        $validated['status'] = $request->input('status', 'draft');

        $announcement = Announcement::create($validated);
        return response()->json($announcement->load('organization', 'createdBy'), 201);
    }

    public function show(Announcement $announcement)
    {
        if ($announcement->status !== 'published' && $announcement->created_by !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $announcement->load('organization', 'createdBy');
    }

    public function update(Request $request, Announcement $announcement)
    {
        if ($announcement->created_by !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!in_array($announcement->status, ['draft', 'rejected'])) {
            return response()->json(['message' => 'Can only edit draft or rejected announcements'], 400);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'visibility_scope' => 'sometimes|in:campus_wide,organization_only,departments,specific_departments',
            'visible_departments' => 'nullable|array',
        ]);

        $announcement->update($validated);
        return response()->json($announcement->load('organization', 'createdBy'));
    }

    public function destroy(Request $request, Announcement $announcement)
    {
        if ($announcement->created_by !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($announcement->status !== 'draft') {
            return response()->json(['message' => 'Can only delete draft announcements'], 400);
        }

        $announcement->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function mySubmissions(Request $request)
    {
        return Announcement::where('created_by', $request->user()->id)
            ->with('organization', 'createdBy')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
