<?php
namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Academic Events
        Event::firstOrCreate(
            ['title' => 'ISU Opening Convocation 2025'],
            [
                'description' => 'Welcome event for all new ISU students.',
                'category' => 'academic',
                'start_date' => '2025-08-10',
                'end_date' => '2025-08-10',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-08-10' => '08:00-17:00']),
                'views_count' => 1250,
                'registration_count' => 850,
                'published_at' => now(),
            ]
        );

        // Social Events
        Event::firstOrCreate(
            ['title' => 'Year-End Campus Assembly 2025'],
            [
                'description' => 'Closing gathering for all students and staff before the holiday break.',
                'category' => 'social',
                'start_date' => '2025-12-02',
                'end_date' => '2025-12-02',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-02' => '09:00-17:00']),
                'views_count' => 980,
                'registration_count' => 650,
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
                'department_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'specific_departments',
                'visible_departments' => json_encode([1]),
                'daily_times' => json_encode(['2025-12-03' => '13:00-18:00']),
                'views_count' => 420,
                'registration_count' => 180,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Student Organizations General Assembly'],
            [
                'description' => 'Coordination meeting for all recognized student organizations.',
                'category' => 'social',
                'start_date' => '2025-12-04',
                'end_date' => '2025-12-04',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-04' => '10:00-16:00']),
                'views_count' => 650,
                'registration_count' => 420,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'ISU Career and Internship Fair'],
            [
                'description' => 'Companies and partner organizations offering internship and job opportunities.',
                'category' => 'academic',
                'start_date' => '2025-12-05',
                'end_date' => '2025-12-05',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-05' => '09:00-17:00']),
                'views_count' => 1890,
                'registration_count' => 1200,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Community Outreach Planning Session'],
            [
                'description' => 'Planning session for the college community extension program.',
                'category' => 'other',
                'start_date' => '2025-12-06',
                'end_date' => '2025-12-06',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => 2,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'specific_departments',
                'visible_departments' => json_encode([2]),
                'daily_times' => json_encode(['2025-12-06' => '14:00-18:00']),
                'views_count' => 280,
                'registration_count' => 95,
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
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-07' => '08:00-17:00']),
                'views_count' => 1450,
                'registration_count' => 920,
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
                'department_id' => 1,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'specific_departments',
                'visible_departments' => json_encode([1]),
                'daily_times' => json_encode(['2025-12-08' => '10:00-17:00']),
                'views_count' => 580,
                'registration_count' => 310,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Student Leadership Training Seminar'],
            [
                'description' => 'Leadership and governance training for student leaders.',
                'category' => 'academic',
                'start_date' => '2025-12-09',
                'end_date' => '2025-12-09',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-09' => '09:00-17:00']),
                'views_count' => 720,
                'registration_count' => 480,
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
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode([
                    '2025-12-10' => '07:00-22:00',
                    '2025-12-11' => '07:00-22:00',
                    '2025-12-12' => '07:00-22:00',
                    '2025-12-13' => '07:00-22:00',
                    '2025-12-14' => '07:00-22:00',
                ]),
                'views_count' => 2150,
                'registration_count' => 1450,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Christmas Lighting and Thanksgiving Program'],
            [
                'description' => 'Campus Christmas lighting ceremony and thanksgiving celebration.',
                'category' => 'social',
                'start_date' => '2025-12-15',
                'end_date' => '2025-12-15',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-15' => '16:00-21:00']),
                'views_count' => 1680,
                'registration_count' => 980,
                'published_at' => now(),
            ]
        );

        // Additional diverse events for better analytics
        Event::firstOrCreate(
            ['title' => 'Photography Workshop Series'],
            [
                'description' => 'Learn mobile and DSLR photography basics.',
                'category' => 'cultural',
                'start_date' => '2025-12-16',
                'end_date' => '2025-12-18',
                'location_id' => 1,
                'organization_id' => 2,
                'department_id' => null,
                'created_by' => 3,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode([
                    '2025-12-16' => '14:00-17:00',
                    '2025-12-17' => '14:00-17:00',
                    '2025-12-18' => '14:00-17:00',
                ]),
                'views_count' => 540,
                'registration_count' => 240,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Debate Championship Finals'],
            [
                'description' => 'Inter-collegiate debate tournament finals.',
                'category' => 'academic',
                'start_date' => '2025-12-19',
                'end_date' => '2025-12-20',
                'location_id' => 1,
                'organization_id' => 2,
                'department_id' => null,
                'created_by' => 3,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode([
                    '2025-12-19' => '09:00-18:00',
                    '2025-12-20' => '09:00-18:00',
                ]),
                'views_count' => 890,
                'registration_count' => 450,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Entrepreneurship Summit 2025'],
            [
                'description' => 'Networking and pitch competition for startup founders.',
                'category' => 'academic',
                'start_date' => '2025-12-21',
                'end_date' => '2025-12-22',
                'location_id' => 1,
                'organization_id' => 2,
                'department_id' => null,
                'created_by' => 3,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode([
                    '2025-12-21' => '08:00-18:00',
                    '2025-12-22' => '09:00-17:00',
                ]),
                'views_count' => 1520,
                'registration_count' => 680,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'New Year Cultural Fest'],
            [
                'description' => 'Celebrate diverse cultures with music, dance, and food.',
                'category' => 'cultural',
                'start_date' => '2025-12-28',
                'end_date' => '2025-12-28',
                'location_id' => 1,
                'organization_id' => 2,
                'department_id' => null,
                'created_by' => 3,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-28' => '15:00-22:00']),
                'views_count' => 2340,
                'registration_count' => 1450,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Tech Talks: AI & Machine Learning'],
            [
                'description' => 'Expert talks on latest trends in AI and ML applications.',
                'category' => 'academic',
                'start_date' => '2025-12-29',
                'end_date' => '2025-12-29',
                'location_id' => 1,
                'organization_id' => 3,
                'department_id' => 1,
                'created_by' => 4,
                'status' => 'published',
                'visibility_scope' => 'specific_departments',
                'visible_departments' => json_encode([1, 3]),
                'daily_times' => json_encode(['2025-12-29' => '10:00-16:00']),
                'views_count' => 760,
                'registration_count' => 420,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Health & Wellness Fair'],
            [
                'description' => 'Mental health awareness, fitness tips, and wellness consultations.',
                'category' => 'social',
                'start_date' => '2025-12-30',
                'end_date' => '2025-12-30',
                'location_id' => 1,
                'organization_id' => 3,
                'department_id' => 2,
                'created_by' => 4,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2025-12-30' => '09:00-16:00']),
                'views_count' => 1100,
                'registration_count' => 680,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Gaming Tournament: Esports Edition'],
            [
                'description' => 'Competitive gaming tournament featuring League of Legends, Valorant, and more.',
                'category' => 'sports',
                'start_date' => '2026-01-02',
                'end_date' => '2026-01-04',
                'location_id' => 1,
                'organization_id' => 3,
                'department_id' => null,
                'created_by' => 4,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode([
                    '2026-01-02' => '12:00-21:00',
                    '2026-01-03' => '12:00-21:00',
                    '2026-01-04' => '12:00-20:00',
                ]),
                'views_count' => 2890,
                'registration_count' => 1850,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Volunteer Orientation Program'],
            [
                'description' => 'Training and onboarding for student volunteers.',
                'category' => 'other',
                'start_date' => '2026-01-05',
                'end_date' => '2026-01-05',
                'location_id' => 1,
                'organization_id' => 1,
                'department_id' => null,
                'created_by' => 2,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode(['2026-01-05' => '10:00-14:00']),
                'views_count' => 420,
                'registration_count' => 280,
                'published_at' => now(),
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Film Festival: Independent Cinema'],
            [
                'description' => 'Showcase of independent and student-made films with Q&A sessions.',
                'category' => 'cultural',
                'start_date' => '2026-01-08',
                'end_date' => '2026-01-10',
                'location_id' => 1,
                'organization_id' => 2,
                'department_id' => null,
                'created_by' => 3,
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'daily_times' => json_encode([
                    '2026-01-08' => '17:00-22:00',
                    '2026-01-09' => '17:00-22:00',
                    '2026-01-10' => '17:00-22:00',
                ]),
                'views_count' => 1230,
                'registration_count' => 750,
                'published_at' => now(),
            ]
        );
    }
}
