<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug Comment System</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Debug Comment System</h1>
    
    <h2>1. Kiểm tra bảng database</h2>
    <?php
    $tables = ['users', 'posts', 'comments', 'categories', 'tags'];
    foreach ($tables as $table) {
        $exists = Schema::hasTable($table);
        echo "<div class='" . ($exists ? 'success' : 'error') . "'>";
        echo "- Bảng '$table': " . ($exists ? "✅ Tồn tại" : "❌ Thiếu");
        echo "</div>";
    }
    ?>
    
    <h2>2. Tạo bảng comments nếu thiếu</h2>
    <?php
    if (!Schema::hasTable('comments')) {
        echo "<div class='info'>Đang tạo bảng comments...</div>";
        try {
            Schema::create('comments', function ($table) {
                $table->id();
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
                $table->text('content');
                $table->boolean('is_approved')->default(true);
                $table->timestamps();
                
                $table->index(['post_id', 'created_at']);
                $table->index(['user_id', 'created_at']);
                $table->index('parent_id');
            });
            echo "<div class='success'>✅ Tạo bảng comments thành công!</div>";
        } catch (Exception $e) {
            echo "<div class='error'>❌ Lỗi: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='success'>✅ Bảng comments đã tồn tại</div>";
    }
    ?>
    
    <h2>3. Thống kê dữ liệu</h2>
    <?php
    echo "<div>👥 Users: " . DB::table('users')->count() . "</div>";
    echo "<div>📝 Posts: " . DB::table('posts')->count() . "</div>";
    echo "<div>💬 Comments: " . DB::table('comments')->count() . "</div>";
    echo "<div>📂 Categories: " . DB::table('categories')->count() . "</div>";
    echo "<div>🏷️ Tags: " . DB::table('tags')->count() . "</div>";
    ?>
    
    <h2>4. Test tạo comment</h2>
    <?php
    try {
        $user = DB::table('users')->first();
        $post = DB::table('posts')->first();
        
        if (!$user || !$post) {
            echo "<div class='error'>❌ Không có user hoặc post để test</div>";
        } else {
            echo "<div>User: {$user->name} (ID: {$user->id})</div>";
            echo "<div>Post: {$post->title} (ID: {$post->id})</div>";
            
            // Test insert comment
            $commentId = DB::table('comments')->insertGetId([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'content' => 'Test comment from debug script',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            echo "<div class='success'>✅ Tạo comment thành công! ID: $commentId</div>";
            
            // Delete test comment
            DB::table('comments')->where('id', $commentId)->delete();
            echo "<div class='info'>🗑️ Đã xóa comment test</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>❌ Lỗi: " . $e->getMessage() . "</div>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
    ?>
    
    <h2>5. Kết luận</h2>
    <div class='success'>
        ✅ Comment system đã sẵn sàng!<br>
        Bạn có thể test bình luận trên website: <a href="/">Trang chủ</a>
    </div>
    
</body>
</html> 