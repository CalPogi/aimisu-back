<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Use a secure password!
            'email_verified_at' => now(),
        ]);
        // Assign role if using Spatie
        $admin->assignRole('admin'); // Or 'super_admin' if that's your role name

        // Regular user
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Use a secure password!
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user'); // Or whatever your regular user role is named
    }
}
