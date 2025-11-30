<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Get existing departments and organizations
        $coe = Department::where('code', 'COE')->first();
        $cas = Department::where('code', 'CAS')->first();
        $cba = Department::where('code', 'CBAPA')->first();

        $acm = Organization::where('name', 'ACM Student Chapter')->first()
            ?? Organization::create(['name' => 'ACM Student Chapter', 'department_id' => $coe?->id]);

        $ieee = Organization::where('name', 'IEEE Student Branch')->first()
            ?? Organization::create(['name' => 'IEEE Student Branch', 'department_id' => $coe?->id]);

        $ssc = Organization::where('name', 'Supreme Student Council')->first();
        $englishClub = Organization::where('name', 'English Club')->first();

        // ====================================
        // ADMIN (no department, no organization)
        // ====================================
        User::firstOrCreate(
            ['email' => 'admin@aimisu.edu.ph'],
            [
                'password' => Hash::make('password'),
                'name' => 'System Admin',
                'role' => 'admin',
                'status' => 'active',
                'department_id' => null,
                'organization_id' => null,
            ]
        );

        // ====================================
        // ORG-ADMINS
        // ====================================

        // ACM Chapter (COE)
        User::firstOrCreate(
            ['email' => 'orgadmin@aimisu.edu.ph'],
            [
                'password' => Hash::make('password'),
                'name' => 'Org Admin - ACM',
                'role' => 'org_admin',
                'status' => 'active',
                'department_id' => $coe?->id,
                'organization_id' => $acm?->id,
            ]
        );

        // IEEE Chapter (COE)
        User::firstOrCreate(
            ['email' => 'ieeeadmin@aimisu.edu.ph'],
            [
                'password' => Hash::make('password'),
                'name' => 'Org Admin - IEEE',
                'role' => 'org_admin',
                'status' => 'active',
                'department_id' => $coe?->id,
                'organization_id' => $ieee?->id,
            ]
        );

        // English Club (CAS)
        if ($englishClub) {
            User::firstOrCreate(
                ['email' => 'englishadmin@aimisu.edu.ph'],
                [
                    'password' => Hash::make('password'),
                    'name' => 'Org Admin - English Club',
                    'role' => 'org_admin',
                    'status' => 'active',
                    'department_id' => $cas?->id,
                    'organization_id' => $englishClub->id,
                ]
            );
        }

        // Supreme Student Council (Campus-Wide)
        if ($ssc) {
            User::firstOrCreate(
                ['email' => 'sscadmin@aimisu.edu.ph'],
                [
                    'password' => Hash::make('password'),
                    'name' => 'Org Admin - SSC',
                    'role' => 'org_admin',
                    'status' => 'active',
                    'department_id' => null,
                    'organization_id' => $ssc->id,
                ]
            );
        }

        // ====================================
        // REGULAR USERS
        // ====================================

        User::firstOrCreate(
            ['email' => 'user@aimisu.edu.ph'],
            [
                'password' => Hash::make('password'),
                'name' => 'Regular User',
                'role' => 'user',
                'status' => 'active',
                'department_id' => $coe?->id,
                'organization_id' => $acm?->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user1@aimisu.edu.ph'],
            [
                'password' => Hash::make('password'),
                'name' => 'CAS User',
                'role' => 'user',
                'status' => 'active',
                'department_id' => $cas?->id,
                'organization_id' => $englishClub?->id,
            ]
        );
    }
}
