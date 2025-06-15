<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixPostsUserId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:posts-user-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix posts table by adding user_id column and data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Fixing posts user_id...');
        
        try {
            // Check if column exists first
            $exists = \Schema::hasColumn('posts', 'user_id');
            
            if (!$exists) {
                $this->info('Adding user_id column...');
                \Schema::table('posts', function ($table) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('category_id');
                    $table->index('user_id');
                });
                $this->info('✅ Added user_id column');
            } else {
                $this->info('✅ user_id column already exists');
            }
            
            // Get first user
            $firstUser = \App\Models\User::first();
            
            if (!$firstUser) {
                $this->info('Creating default user...');
                $firstUser = \App\Models\User::create([
                    'name' => 'Admin',
                    'email' => 'admin@blog.com',
                    'password' => \Hash::make('password'),
                    'email_verified_at' => now()
                ]);
                $this->info("✅ Created default user: {$firstUser->name}");
            } else {
                $this->info("✅ Found user: {$firstUser->name} (ID: {$firstUser->id})");
            }
            
            // Update posts without user_id
            $postsCount = \DB::table('posts')->whereNull('user_id')->count();
            
            if ($postsCount > 0) {
                $this->info("Updating {$postsCount} posts...");
                
                $updated = \DB::table('posts')
                    ->whereNull('user_id')
                    ->update(['user_id' => $firstUser->id]);
                    
                $this->info("✅ Updated {$updated} posts");
            } else {
                $this->info('✅ All posts already have user_id');
            }
            
            // Verify results
            $total = \DB::table('posts')->count();
            $withUserId = \DB::table('posts')->whereNotNull('user_id')->count();
            
            $this->info("\n📊 Results:");
            $this->info("Total posts: {$total}");
            $this->info("Posts with user_id: {$withUserId}");
            $this->info("Posts without user_id: " . ($total - $withUserId));
            
            if ($total === $withUserId) {
                $this->info("\n🎉 SUCCESS! All posts now have user_id");
                $this->info("Login should work now!");
                return 0;
            } else {
                $this->warn("\n⚠️ Warning: Some posts still missing user_id");
                return 1;
            }
            
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            return 1;
        }
    }
}
