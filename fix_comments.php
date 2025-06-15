<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "🔧 Fix Comments System...<br><br>";

// Kiểm tra bảng comments
if (!Schema::hasTable('comments')) {
    echo "❌ Bảng comments không tồn tại. Đang tạo...<br>";
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
        echo "✅ Tạo bảng comments thành công!<br>";
    } catch (Exception $e) {
        echo "❌ Lỗi: " . $e->getMessage() . "<br>";
        exit;
    }
} else {
    echo "✅ Bảng comments đã tồn tại<br>";
}

// Test tạo comment
echo "<br>🧪 Test tạo comment...<br>";
try {
    $user = DB::table('users')->first();
    $post = DB::table('posts')->first();
    
    if ($user && $post) {
        $testId = DB::table('comments')->insertGetId([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => 'Test comment - ' . date('Y-m-d H:i:s'),
            'is_approved' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        echo "✅ Test thành công! Comment ID: $testId<br>";
        
        // Xóa comment test
        DB::table('comments')->where('id', $testId)->delete();
        echo "🗑️ Đã xóa comment test<br>";
        
    } else {
        echo "❌ Không có user hoặc post để test<br>";
    }
} catch (Exception $e) {
    echo "❌ Lỗi test: " . $e->getMessage() . "<br>";
}

echo "<br>🎉 <strong style='color: green;'>Comment system đã sẵn sàng!</strong><br>";
echo "👉 <a href='/'>Quay lại trang chủ để test</a><br>";

// Redirect sau 3 giây
echo "<script>
setTimeout(function() {
    window.location.href = '/';
}, 3000);
</script>"; 