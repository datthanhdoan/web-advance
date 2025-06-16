<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class UpdatePostImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:update-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update post images and generate SQL commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🖼️ Analyzing post images...');
        
        // Lấy tất cả posts
        $posts = Post::select('id', 'title', 'featured_image', 'excerpt')->get();
        
        $this->info("📊 Found {$posts->count()} posts\n");
        
        // Hiển thị posts hiện tại
        $this->info('📄 Current posts:');
        $this->line(str_repeat('-', 100));
        
        $headers = ['ID', 'Title', 'Current Image', 'Excerpt Preview'];
        $rows = [];
        
        foreach ($posts as $post) {
            $excerpt = mb_substr(strip_tags($post->excerpt ?? ''), 0, 30, 'UTF-8');
            $image = $post->featured_image ?: 'NULL';
            
            $rows[] = [
                $post->id,
                mb_substr($post->title, 0, 40, 'UTF-8'),
                mb_substr($image, 0, 30, 'UTF-8'),
                $excerpt . '...'
            ];
        }
        
        $this->table($headers, $rows);
        
        // Ảnh mẫu đẹp từ Unsplash
        $beautifulImages = [
            'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?w=800&h=600&fit=crop', // Technology
            'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop', // Nature
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop', // Business
            'https://images.unsplash.com/photo-1516796181074-bf453fbfa3e6?w=800&h=600&fit=crop', // Lifestyle
            'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&h=600&fit=crop', // Education
            'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=600&fit=crop', // Travel
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop', // Food
            'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&h=600&fit=crop', // Health
            'https://images.unsplash.com/photo-1507146426996-ef05306b995a?w=800&h=600&fit=crop', // Science
            'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=800&h=600&fit=crop'  // Art
        ];
        
        $this->newLine();
        $this->info('📝 SQL Commands for MySQL Dashboard:');
        $this->line(str_repeat('=', 80));
        $this->comment('-- Copy these commands and run in phpMyAdmin or MySQL Workbench:');
        $this->newLine();
        
        foreach ($posts as $index => $post) {
            $imageUrl = $beautifulImages[$index % count($beautifulImages)];
            $cleanTitle = addslashes($post->title);
            $this->line("UPDATE posts SET featured_image = '{$imageUrl}' WHERE id = {$post->id}; -- {$cleanTitle}");
        }
        
        $this->newLine();
        $this->line(str_repeat('=', 80));
        
        // Tạo file SQL
        $sqlContent = "-- Update post images with beautiful Unsplash photos\n";
        $sqlContent .= "-- Generated: " . now() . "\n\n";
        $sqlContent .= "USE web_advance;\n\n";
        
        foreach ($posts as $index => $post) {
            $imageUrl = $beautifulImages[$index % count($beautifulImages)];
            $cleanTitle = addslashes($post->title);
            $sqlContent .= "UPDATE posts SET featured_image = '{$imageUrl}' WHERE id = {$post->id}; -- {$cleanTitle}\n";
        }
        
        file_put_contents('update_post_images.sql', $sqlContent);
        $this->info('💾 Saved SQL commands to: update_post_images.sql');
        
        $this->newLine();
        $this->info('🎯 Next Steps:');
        $this->line('1. Open phpMyAdmin or MySQL Workbench');
        $this->line('2. Select the "web_advance" database');
        $this->line('3. Copy and paste the SQL commands above');
        $this->line('4. Execute the commands');
        $this->line('5. Refresh your website to see beautiful images!');
        
        $this->newLine();
        $this->comment('💡 Alternative: Run "php artisan posts:apply-images" to apply automatically');
        
        if ($this->confirm('🚀 Do you want to apply these images automatically now?', false)) {
            $this->applyImages($posts, $beautifulImages);
        }
        
        return 0;
    }
    
    private function applyImages($posts, $beautifulImages)
    {
        $this->info('🔄 Applying images...');
        
        $bar = $this->output->createProgressBar($posts->count());
        $bar->start();
        
        foreach ($posts as $index => $post) {
            $imageUrl = $beautifulImages[$index % count($beautifulImages)];
            
            $post->update(['featured_image' => $imageUrl]);
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        
        $this->info('🎉 Successfully updated all post images!');
        $this->comment('Check your website now - all posts should have beautiful preview images.');
    }
}
