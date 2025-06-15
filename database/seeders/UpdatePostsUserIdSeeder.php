<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class UpdatePostsUserIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user or create one if none exists
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Created admin user: admin@example.com / password');
        }

        // Update all posts without user_id
        $postsUpdated = Post::whereNull('user_id')->update(['user_id' => $user->id]);
        
        $this->command->info("Updated {$postsUpdated} posts with user_id = {$user->id}");
    }
} 