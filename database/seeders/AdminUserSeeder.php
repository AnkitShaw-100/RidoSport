<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = env('ADMIN_EMAIL', 'ridosport@gmail.com');
        $adminPassword = env('ADMIN_PASSWORD', 'RidoSport@123');

        User::whereIn('email', [
            'admin@example.com',
        ])->where('email', '!=', $adminEmail)->delete();

        User::updateOrCreate([
            'email' => $adminEmail,
        ], [
            'name' => 'RidoSport Admin',
            'password' => Hash::make($adminPassword),
            'role' => 'admin',
            'admin' => true, // Set this user as an admin
        ]);
    }
}
