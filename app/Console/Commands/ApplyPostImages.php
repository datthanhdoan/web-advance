<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class ApplyPostImages extends Command
{
    protected $signature = 'posts:apply-images';
    protected $description = 'Apply beautiful images to all posts immediately';

    public function handle()
    {
        $this->info('🖼️ Applying beautiful images to posts in mini_blog database...');
        
        // Ảnh WORKING từ Unsplash do user cung cấp
        $workingImages = [
            'https://images.unsplash.com/photo-1749498682646-45e7c11506ec?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Image 1
            'https://images.unsplash.com/photo-1726066012822-d22831b628d9?q=80&w=2574&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Image 2
            'https://images.unsplash.com/photo-1744137285276-57ca4048f805?q=80&w=2576&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Image 3
            'https://images.unsplash.com/photo-1746068521443-9332b12c9ed8?q=80&w=2574&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Image 4
            'https://images.unsplash.com/photo-1749046147908-e2879724fd0c?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw0MHx8fGVufDB8fHx8fA%3D%3D', // Image 5
        ];
        
        try {
            $posts = Post::all();
            
            if ($posts->isEmpty()) {
                $this->warn('No posts found in database!');
                return 1;
            }
            
            $this->info("Found {$posts->count()} posts to update in mini_blog database");
            
            // Mapping posts với working images (reuse as needed)
            $imageMapping = [
                1 => $workingImages[0], // Laravel
                2 => $workingImages[1], // Cooking  
                3 => $workingImages[2], // Travel Dalat
                4 => $workingImages[3], // Plants/Gardening
                5 => $workingImages[4], // Finance
                6 => $workingImages[0], // Yoga (reuse image 1)
                7 => $workingImages[1], // UI/UX (reuse image 2)  
                8 => $workingImages[2], // Career/CV (reuse image 3)
            ];

            $updated = 0;
            foreach ($posts as $post) {
                if (isset($imageMapping[$post->id])) {
                    $imageUrl = $imageMapping[$post->id];
                } else {
                    // Fallback for any extra posts
                    $imageUrl = $workingImages[0]; // Default to first image
                }
                
                $post->update(['featured_image' => $imageUrl]);
                
                $this->comment("✅ Post {$post->id}: '{$post->title}' → Working image updated");
                $updated++;
            }
            
            $this->newLine();
            $this->info("🎉 SUCCESS! Updated {$updated} posts with WORKING preview images!");
            $this->comment('🌟 Your mini_blog will look amazing now - check localhost:8000!');
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            return 1;
        }
    }
} 