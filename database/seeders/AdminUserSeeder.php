<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@blog.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Created admin user:');
        $this->command->info('📧 Email: admin@blog.com');
        $this->command->info('🔑 Password: password123');

        // Create demo user
        $demo = User::create([
            'name' => 'Demo User',
            'email' => 'demo@blog.com',
            'password' => Hash::make('demo123'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Created demo user:');
        $this->command->info('📧 Email: demo@blog.com');
        $this->command->info('🔑 Password: demo123');
    }
} 