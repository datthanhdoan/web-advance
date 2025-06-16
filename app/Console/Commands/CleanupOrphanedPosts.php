<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\User;

class CleanupOrphanedPosts extends Command
{
    protected $signature = 'posts:cleanup-orphaned {--force : Force delete without confirmation}';
    protected $description = 'Clean up posts with non-existent user_id';

    public function handle()
    {
        $this->info('=== CLEANUP ORPHANED POSTS ===');
        $this->newLine();

        // Tìm tất cả posts có user_id không tồn tại
        $orphanedPosts = Post::whereNotIn('user_id', User::pluck('id'))->get();

        $this->info("Found {$orphanedPosts->count()} orphaned posts:");

        if ($orphanedPosts->count() > 0) {
            // Hiển thị danh sách posts
            $headers = ['ID', 'Title', 'User ID', 'Created At'];
            $rows = [];
            
            foreach ($orphanedPosts as $post) {
                $rows[] = [
                    $post->id,
                    substr($post->title, 0, 50) . (strlen($post->title) > 50 ? '...' : ''),
                    $post->user_id,
                    $post->created_at->format('Y-m-d H:i:s')
                ];
            }
            
            $this->table($headers, $rows);
            
            // Xác nhận xóa
            if ($this->option('force') || $this->confirm('Do you want to delete these orphaned posts?')) {
                $deletedCount = Post::whereNotIn('user_id', User::pluck('id'))->delete();
                $this->success("✅ Successfully deleted {$deletedCount} orphaned posts.");
            } else {
                $this->warn('❌ Cleanup cancelled.');
            }
        } else {
            $this->info('No orphaned posts found.');
        }

        $this->newLine();
        $this->info('=== CLEANUP COMPLETED ===');
    }
} 