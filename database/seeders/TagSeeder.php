<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // Technology tags
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#FF2D20'],
            ['name' => 'PHP', 'slug' => 'php', 'color' => '#777BB4'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => '#F7DF1E'],
            ['name' => 'React', 'slug' => 'react', 'color' => '#61DAFB'],
            ['name' => 'Vue.js', 'slug' => 'vuejs', 'color' => '#4FC08D'],
            ['name' => 'AI', 'slug' => 'ai', 'color' => '#FF6B6B'],
            ['name' => 'Machine Learning', 'slug' => 'machine-learning', 'color' => '#4ECDC4'],
            ['name' => 'Blockchain', 'slug' => 'blockchain', 'color' => '#45B7D1'],
            
            // Business tags
            ['name' => 'Marketing', 'slug' => 'marketing', 'color' => '#96CEB4'],
            ['name' => 'Startup', 'slug' => 'startup', 'color' => '#FECA57'],
            ['name' => 'Leadership', 'slug' => 'leadership', 'color' => '#FF9FF3'],
            ['name' => 'Management', 'slug' => 'management', 'color' => '#54A0FF'],
            ['name' => 'Finance', 'slug' => 'finance', 'color' => '#5F27CD'],
            
            // Lifestyle tags
            ['name' => 'Productivity', 'slug' => 'productivity', 'color' => '#00D2D3'],
            ['name' => 'Self Improvement', 'slug' => 'self-improvement', 'color' => '#FF9F43'],
            ['name' => 'Wellness', 'slug' => 'wellness', 'color' => '#FF6B6B'],
            ['name' => 'Fitness', 'slug' => 'fitness', 'color' => '#1DD1A1'],
            ['name' => 'Mental Health', 'slug' => 'mental-health', 'color' => '#FD79A8'],
            
            // General tags
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => '#6C5CE7'],
            ['name' => 'Tips', 'slug' => 'tips', 'color' => '#A29BFE'],
            ['name' => 'Guide', 'slug' => 'guide', 'color' => '#FD79A8'],
            ['name' => 'Review', 'slug' => 'review', 'color' => '#FDCB6E'],
            ['name' => 'News', 'slug' => 'news', 'color' => '#E17055'],
            ['name' => 'Opinion', 'slug' => 'opinion', 'color' => '#74B9FF'],
            ['name' => 'Experience', 'slug' => 'experience', 'color' => '#55A3FF'],
            
            // Creative tags
            ['name' => 'Design', 'slug' => 'design', 'color' => '#E84393'],
            ['name' => 'Photography', 'slug' => 'photography', 'color' => '#2D3436'],
            ['name' => 'Art', 'slug' => 'art', 'color' => '#A29BFE'],
            ['name' => 'Writing', 'slug' => 'writing', 'color' => '#636E72'],
            ['name' => 'Creative', 'slug' => 'creative', 'color' => '#FDA7DF'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
} 