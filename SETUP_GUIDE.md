# Hướng dẫn cài đặt Medium-Style Blog System

## Tổng quan
Đây là một hệ thống blog hoàn chỉnh với UI giống Medium.com, được xây dựng bằng Laravel và MySQL.

### Tính năng chính
- ✅ Quản lý bài viết (CRUD) - tạo, xem, sửa, xóa bài viết
- ✅ Hệ thống phân loại với Categories và Tags
- ✅ Chức năng tìm kiếm bài viết
- ✅ UI/UX giống Medium.com
- ✅ Upload và quản lý ảnh đại diện
- ✅ Responsive design
- ✅ SEO-friendly với slug URLs

### Công nghệ sử dụng
- **Backend**: Laravel 11, PHP 8.2+
- **Database**: MySQL
- **Frontend**: Blade Templates, Tailwind CSS, Vanilla JavaScript
- **Server**: XAMPP (Apache + MySQL)

## Yêu cầu hệ thống

- PHP >= 8.2
- Composer
- Node.js >= 16
- XAMPP (Apache + MySQL)
- Git

## Hướng dẫn cài đặt

### Bước 1: Clone dự án và cài đặt dependencies

```bash
# Clone repository
cd C:\xampp\htdocs
git clone <your-repo-url> web-advance
cd web-advance

# Cài đặt PHP dependencies
composer install

# Cài đặt Node.js dependencies
npm install
```

### Bước 2: Cấu hình môi trường

```bash
# Copy file môi trường
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Bước 3: Cấu hình database

1. **Mở XAMPP Control Panel và start Apache + MySQL**

2. **Tạo database mới:**
   - Truy cập: http://localhost/phpmyadmin
   - Tạo database mới tên: `medium_blog`
   - Charset: `utf8mb4_unicode_ci`

3. **Cập nhật file .env:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medium_blog
DB_USERNAME=root
DB_PASSWORD=
```

### Bước 4: Thiết lập database

```bash
# Chạy migrations để tạo bảng
php artisan migrate

# Chạy seeders để tạo dữ liệu mẫu
php artisan db:seed

# Tạo storage link cho upload files
php artisan storage:link
```

### Bước 5: Build assets

```bash
# Development mode
npm run dev

# Hoặc production mode
npm run build
```

### Bước 6: Chạy ứng dụng

```bash
# Chạy Laravel development server
php artisan serve
```

Truy cập: http://localhost:8000

## Cấu trúc Database

### Bảng `categories`
- id, name, slug, description, color, timestamps

### Bảng `tags`  
- id, name, slug, color, timestamps

### Bảng `posts`
- id, title, slug, excerpt, content, featured_image, status, published_at, read_time, views, category_id, timestamps

### Bảng `post_tag` (pivot)
- id, post_id, tag_id, timestamps

## Hướng dẫn sử dụng

### 1. Trang chủ
- Hiển thị bài viết nổi bật và mới nhất
- Sidebar với categories và tags phổ biến

### 2. Tạo bài viết mới
- Truy cập: http://localhost:8000/posts/create
- Điền form với tiêu đề, nội dung, category, tags
- Upload ảnh đại diện (tùy chọn)
- Chọn trạng thái: Draft hoặc Published

### 3. Quản lý bài viết
- Xem danh sách: http://localhost:8000/posts
- Chỉnh sửa: Click vào bài viết > nút "Chỉnh sửa"
- Xóa: Click vào bài viết > nút "Xóa"

### 4. Tìm kiếm
- Sử dụng search box trên header
- Tìm trong title, content, category, tags

### 5. Phân loại
- Xem theo category: http://localhost:8000/category/{slug}
- Xem theo tag: http://localhost:8000/tag/{slug}

## Tính năng nâng cao

### Memory Bank System
Hệ thống lưu trữ thông tin về dự án trong `/memory_bank/` để AI có thể hiểu và phát triển tiếp.

### Auto Features
- **Auto Slug**: Tự động tạo slug từ tiêu đề
- **Auto Excerpt**: Tự động tạo tóm tắt từ nội dung
- **Read Time**: Tự động tính thời gian đọc
- **View Counter**: Đếm lượt xem bài viết

### SEO Features
- Friendly URLs với slug
- Meta tags (có thể mở rộng)
- Structured data (có thể mở rộng)

## Troubleshooting

### Lỗi composer install
```bash
# Cập nhật composer
composer self-update
composer update
```

### Lỗi npm install
```bash
# Xóa node_modules và reinstall
rm -rf node_modules
rm package-lock.json
npm install
```

### Lỗi database connection
- Kiểm tra XAMPP MySQL đã chạy chưa
- Kiểm tra tên database trong .env
- Kiểm tra username/password

### Lỗi storage link
- Xóa link cũ: `rm public/storage`
- Tạo lại: `php artisan storage:link`

### Lỗi permission (Linux/Mac)
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

## Mở rộng thêm

### Thêm tính năng mới
1. Tạo migration: `php artisan make:migration create_table_name`
2. Tạo model: `php artisan make:model ModelName`
3. Tạo controller: `php artisan make:controller ControllerName`
4. Thêm routes trong `routes/web.php`
5. Tạo views trong `resources/views/`

### Customize UI
- CSS được viết inline trong Blade templates
- Có thể tách ra thành file CSS riêng
- Sử dụng Tailwind CSS classes

### Performance
- Enable caching: `php artisan config:cache`
- Optimize autoloader: `composer dump-autoload -o`
- Use queues cho heavy tasks

## Liên hệ & Hỗ trợ

Nếu gặp vấn đề trong quá trình cài đặt hoặc sử dụng, vui lòng:
1. Kiểm tra log files: `storage/logs/laravel.log`
2. Chạy `php artisan optimize:clear` để clear cache
3. Restart XAMPP services

---

**Chúc bạn sử dụng hệ thống blog thành công! 🚀** 