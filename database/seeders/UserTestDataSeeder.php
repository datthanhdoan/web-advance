<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu users test đa dạng
        $testUsers = [
            [
                'name' => 'Nguyễn Văn An',
                'email' => 'nguyenvanan@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(6),
                'updated_at' => now()->subMonths(6),
            ],
            [
                'name' => 'Trần Thị Bình',
                'email' => 'tranthibinh@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(4),
                'updated_at' => now()->subMonths(4),
            ],
            [
                'name' => 'Lê Minh Cường',
                'email' => 'leminhcuong@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(8),
                'updated_at' => now()->subMonths(8),
            ],
            [
                'name' => 'Phạm Thu Dung',
                'email' => 'phamthudung@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(3),
                'updated_at' => now()->subMonths(3),
            ],
            [
                'name' => 'Hoàng Văn Em',
                'email' => 'hoangvanem@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(5),
                'updated_at' => now()->subMonths(5),
            ],
            [
                'name' => 'Đỗ Thị Phương',
                'email' => 'dothiphuong@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(7),
                'updated_at' => now()->subMonths(7),
            ],
            [
                'name' => 'Vũ Minh Tuấn',
                'email' => 'vuminhtuan@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(9),
                'updated_at' => now()->subMonths(9),
            ],
            [
                'name' => 'Ngô Thị Lan',
                'email' => 'ngothilan@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ],
            [
                'name' => 'Bùi Văn Hùng',
                'email' => 'buivanhung@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(12),
                'updated_at' => now()->subMonths(12),
            ],
            [
                'name' => 'Lý Thị Mai',
                'email' => 'lythimai@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(1),
                'updated_at' => now()->subMonths(1),
            ],
            [
                'name' => 'Trương Văn Đức',
                'email' => 'truongvanduc@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(10),
                'updated_at' => now()->subMonths(10),
            ],
            [
                'name' => 'Phan Thị Hoa',
                'email' => 'phanthihoa@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subMonths(11),
                'updated_at' => now()->subMonths(11),
            ],
            [
                'name' => 'Đinh Văn Long',
                'email' => 'dinhvanlong@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subWeeks(3),
                'updated_at' => now()->subWeeks(3),
            ],
            [
                'name' => 'Võ Thị Ngọc',
                'email' => 'vothingoc@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subWeeks(2),
                'updated_at' => now()->subWeeks(2),
            ],
            [
                'name' => 'Hồ Văn Tài',
                'email' => 'hovantai@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subWeeks(1),
                'updated_at' => now()->subWeeks(1),
            ],
            [
                'name' => 'Đặng Thị Linh',
                'email' => 'dangthilinh@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'name' => 'Lương Văn Minh',
                'email' => 'luongvanminh@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'name' => 'Chu Thị Hương',
                'email' => 'chuthihuong@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'name' => 'Tạ Văn Quang',
                'email' => 'tavanquang@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
            [
                'name' => 'Phùng Thị Yến',
                'email' => 'phungthiyen@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
        ];

        foreach ($testUsers as $userData) {
            // Kiểm tra xem user đã tồn tại chưa
            if (!User::where('email', $userData['email'])->exists()) {
                User::create($userData);
            }
        }

        $this->command->info('Đã tạo ' . count($testUsers) . ' users test thành công!');
    }
}
