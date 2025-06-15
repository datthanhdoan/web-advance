<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('read_time')->default(0); // Thời gian đọc tính bằng phút
            $table->integer('views')->default(0);
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('published_at');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}; 