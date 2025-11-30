<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'name' => 'ISU Main Auditorium',
                'address' => 'ISU Echague, Main Campus',
                'latitude' => 16.6916,
                'longitude' => 121.6774,
                'category' => 'auditorium',
                'capacity' => 1000,
            ],
            [
                'name' => 'Sports Field',
                'address' => 'ISU Echague, Sports Area',
                'latitude' => 16.6930,
                'longitude' => 121.6788,
                'category' => 'field',
                'capacity' => 1500,
            ],
            [
                'name' => 'Engineering Lobby',
                'address' => 'ISU COE Building',
                'latitude' => 16.6921,
                'longitude' => 121.6765,
                'category' => 'classroom',
            ],
        ];

        foreach ($locations as $loc) {
            Location::firstOrCreate(['name' => $loc['name']], $loc);
        }
    }
}
