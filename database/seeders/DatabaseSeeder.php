<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\Role; // Import the Role enum
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
  public function run(): void
{
    // Seed a few test users with passwords from 1 to 8
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role' => Role::User->value, // Set the role to 'user'
        'password' => bcrypt('password1'), // Set password for the test user
    ]);

    // Seed an admin user with password 'password2'
    User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@gmail.com',
        'role' => Role::Admin->value, // Set the role to 'admin'
        'password' => bcrypt('admin12345'), // Set password for the admin user
    ]);

    // You can add more users with different passwords from 3 to 8 if needed
    // Example:
    User::factory()->create([
        'name' => 'User 3',
        'email' => 'user3@example.com',
        'role' => Role::User->value,
        'password' => bcrypt('password3'),
    ]);

    User::factory()->create([
        'name' => 'User 4',
        'email' => 'user4@example.com',
        'role' => Role::User->value,
        'password' => bcrypt('password4'),
    ]);

    // Add more users if needed...
}

}
