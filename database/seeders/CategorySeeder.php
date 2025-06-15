<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Công nghệ',
                'slug' => 'cong-nghe',
                'description' => 'Tin tức và bài viết về công nghệ, phần mềm, phần cứng',
                'color' => '#3B82F6'
            ],
            [
                'name' => 'Kinh doanh',
                'slug' => 'kinh-doanh',
                'description' => 'Khởi nghiệp, quản lý, marketing và chiến lược kinh doanh',
                'color' => '#10B981'
            ],
            [
                'name' => 'Sức khỏe',
                'slug' => 'suc-khoe',
                'description' => 'Sức khỏe thể chất, tinh thần và lối sống lành mạnh',
                'color' => '#EF4444'
            ],
            [
                'name' => 'Du lịch',
                'slug' => 'du-lich',
                'description' => 'Khám phá thế giới, địa điểm du lịch và trải nghiệm',
                'color' => '#F59E0B'
            ],
            [
                'name' => 'Giáo dục',
                'slug' => 'giao-duc',
                'description' => 'Học tập, kỹ năng và phát triển bản thân',
                'color' => '#8B5CF6'
            ],
            [
                'name' => 'Ẩm thực',
                'slug' => 'am-thuc',
                'description' => 'Món ăn, công thức nấu ăn và văn hóa ẩm thực',
                'color' => '#F97316'
            ],
            [
                'name' => 'Thể thao',
                'slug' => 'the-thao',
                'description' => 'Tin tức thể thao, bóng đá, và các môn thể thao khác',
                'color' => '#06B6D4'
            ],
            [
                'name' => 'Nghệ thuật',
                'slug' => 'nghe-thuat',
                'description' => 'Hội họa, âm nhạc, điện ảnh và các loại hình nghệ thuật',
                'color' => '#EC4899'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 