<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        $adminPassword = env('ADMIN_PASSWORD', 'ChangeThisAdminPassword!2026');

        User::updateOrCreate([
            'email' => $adminEmail,
        ], [
            'name' => 'Admin',
            'password' => Hash::make($adminPassword),
            'role' => 'admin',
            'admin' => true, // Set this user as an admin
        ]);
    }
}
