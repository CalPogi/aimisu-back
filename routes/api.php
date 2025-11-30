<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuditLogController;
use Illuminate\Support\Facades\Route;

// ============================================
// PUBLIC ROUTES
// ============================================

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// ============================================
// PROTECTED ROUTES (auth:sanctum required)
// ============================================

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // ========================================
    // ADMIN ONLY ROUTES
    // ========================================

    Route::middleware('check.admin')->group(function () {
        // Admin Approvals & Analytics
        Route::get('/admin/pending-approvals', [AdminController::class, 'pendingApprovals']);
        Route::post('/admin/events/{event}/approve', [AdminController::class, 'approveEvent']);
        Route::post('/admin/events/{event}/reject', [AdminController::class, 'rejectEvent']);
        Route::post('/admin/announcements/{announcement}/approve', [AdminController::class, 'approveAnnouncement']);
        Route::post('/admin/announcements/{announcement}/reject', [AdminController::class, 'rejectAnnouncement']);
        Route::get('/admin/analytics/dashboard', [AdminController::class, 'analyticsDashboard']);
        Route::get('/admin/analytics/events', [AdminController::class, 'analyticsEvents']);
        Route::get('/admin/analytics/departments', [AdminController::class, 'analyticsDepartments']);

        // Department CRUD (admin only)
        Route::apiResource('departments', DepartmentController::class);

        // Organization CRUD (admin only)
        Route::apiResource('organizations', OrganizationController::class);

        // Location CRUD (admin only)
        Route::apiResource('locations', LocationController::class);

        // User CRUD (admin only)
        Route::apiResource('users', UserController::class);

        // Audit Logs - ADD THIS
        Route::get('/audit-logs', [AuditLogController::class, 'index']);
    });

    // ========================================
    // ORG-ADMIN ROUTES (can create/edit own events & announcements)
    // ========================================

    Route::middleware('check.org_admin')->group(function () {
        // Create events
        Route::post('/events', [EventController::class, 'store']);
        Route::get('/events/my-submissions', [EventController::class, 'mySubmissions']);
        Route::put('/events/{event}', [EventController::class, 'update']);
        Route::delete('/events/{event}', [EventController::class, 'destroy']);
        Route::post('/events/{event}/submit', [EventController::class, 'submitForApproval']);

        // Create announcements
        Route::post('/announcements', [AnnouncementController::class, 'store']);
        Route::get('/announcements/my-submissions', [AnnouncementController::class, 'mySubmissions']);
        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update']);
        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy']);
        Route::post('/announcements/{announcement}/submit', [AnnouncementController::class, 'submitForApproval']);
    });

    // ========================================
    // PUBLIC/END-USER ROUTES (all authenticated users)
    // ========================================

    // View events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);

    // View announcements
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show']);

    // View locations
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{location}', [LocationController::class, 'show']);

    // View departments & organizations
    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::get('/organizations', [OrganizationController::class, 'index']);


});
