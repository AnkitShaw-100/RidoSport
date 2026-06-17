<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ServiceListSeeder; // Add this line
use Database\Seeders\ProjectsSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // Seed a regular user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'admin' => false,
        // ]);

        // // Seed an admin user
        // User::factory()->admin()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('admin_password'), // Use a secure password
        // ]);



         // Call the AdminUserSeeder
        //  $this->call(AdminUserSeeder::class);
        //  $this->call(ServiceListSeeder::class);
        $this->call(ProjectsSeeder::class);


    }
}
