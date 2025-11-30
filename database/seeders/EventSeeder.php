<?php
namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::firstOrCreate(
            ['title' => 'ISU Opening Convocation 2025'],
            [
                'description' => 'Welcome event for all new ISU students.',
                'category' => 'academic',
                'start_date' => '2025-08-10',
                'end_date' => '2025-08-10',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Year-End Campus Assembly 2025'],
            [
                'description' => 'Closing gathering for all students and staff before the holiday break.',
                'category' => 'campus_life',
                'start_date' => '2025-12-02',
                'end_date' => '2025-12-02',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Computer Science Research Colloquium'],
            [
                'description' => 'Student and faculty presentations on recent research projects.',
                'category' => 'academic',
                'start_date' => '2025-12-03',
                'end_date' => '2025-12-03',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'department_only',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Student Organizations General Assembly'],
            [
                'description' => 'Coordination meeting for all recognized student organizations.',
                'category' => 'organization',
                'start_date' => '2025-12-04',
                'end_date' => '2025-12-04',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'ISU Career and Internship Fair'],
            [
                'description' => 'Companies and partner organizations offering internship and job opportunities.',
                'category' => 'career',
                'start_date' => '2025-12-05',
                'end_date' => '2025-12-05',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Community Outreach Planning Session'],
            [
                'description' => 'Planning session for the college community extension program.',
                'category' => 'community',
                'start_date' => '2025-12-06',
                'end_date' => '2025-12-06',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'organization_only',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Intramurals Championship Day'],
            [
                'description' => 'Final games and awarding for the 2025 intramurals.',
                'category' => 'sports',
                'start_date' => '2025-12-07',
                'end_date' => '2025-12-07',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'IT Department Project Showcase'],
            [
                'description' => 'Capstone and major project presentations from IT students.',
                'category' => 'academic',
                'start_date' => '2025-12-08',
                'end_date' => '2025-12-08',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'department_only',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Student Leadership Training Seminar'],
            [
                'description' => 'Leadership and governance training for student leaders.',
                'category' => 'training',
                'start_date' => '2025-12-09',
                'end_date' => '2025-12-09',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'organization_only',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Library Extended Hours Review Week'],
            [
                'description' => 'Extended library hours to support students during finals review.',
                'category' => 'academic',
                'start_date' => '2025-12-10',
                'end_date' => '2025-12-14',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Christmas Lighting and Thanksgiving Program'],
            [
                'description' => 'Campus Christmas lighting ceremony and thanksgiving celebration.',
                'category' => 'campus_life',
                'start_date' => '2025-12-15',
                'end_date' => '2025-12-15',
                'location_id' => 1,
                'organization_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );
    }
}
