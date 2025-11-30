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
                'location_id' => 1, // Assume seeded above
                'organization_id' => 1, // Adjust to match an org in your db
                'created_by' => 2, // Org-Admin ID (adjust as needed)
                'status' => 'published',
                'visibility_scope' => 'campus_wide',
                'published_at' => now(),
            ]
        );
    }
}
