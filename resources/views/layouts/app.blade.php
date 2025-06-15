<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/outline/index.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
        }
        
        .medium-container {
            max-width: 1192px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .medium-header {
            border-bottom: 1px solid #e6e6e6;
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        .medium-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 75px;
        }
        
        .medium-logo {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            text-decoration: none;
            letter-spacing: -0.02em;
        }
        
        .medium-search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
            margin: 0 40px;
        }
        
        .medium-search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: none;
            background: #f7f7f7;
            border-radius: 25px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }
        
        .medium-search-input:focus {
            background: #fff;
            box-shadow: 0 0 0 1px #1a8917;
        }
        
        .medium-search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #6b6b6b;
        }
        
        .medium-nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .medium-btn {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .medium-btn-primary {
            background: #1a8917;
            color: #fff;
            border: 1px solid #1a8917;
        }
        
        .medium-btn-primary:hover {
            background: #156d12;
            color: #fff;
        }
        
        .medium-btn-outline {
            background: transparent;
            color: #1a8917;
            border: 1px solid #1a8917;
        }
        
        .medium-btn-outline:hover {
            background: #1a8917;
            color: #fff;
        }
        
        .medium-footer {
            border-top: 1px solid #e6e6e6;
            background: #f7f7f7;
            padding: 40px 0;
            margin-top: 60px;
        }
        
        .medium-footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }
        
        .medium-footer-section h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1a1a1a;
        }
        
        .medium-footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .medium-footer-section ul li {
            margin-bottom: 8px;
        }
        
        .medium-footer-section ul li a {
            color: #6b6b6b;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s ease;
        }
        
        .medium-footer-section ul li a:hover {
            color: #1a1a1a;
        }
        
        .medium-footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #e6e6e6;
            color: #6b6b6b;
            font-size: 14px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .medium-nav {
                height: 60px;
            }
            
            .medium-search-box {
                display: none;
            }
            
            .medium-logo {
                font-size: 28px;
            }
            
            .medium-container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Header -->
    <header class="medium-header">
        <div class="medium-container">
            <nav class="medium-nav">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="medium-logo">
                    Medium
                </a>
                
                <!-- Search Box -->
                <div class="medium-search-box">
                    <form action="{{ route('posts.search') }}" method="GET">
                        <div class="relative">
                            <svg class="medium-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input 
                                type="text" 
                                name="q" 
                                placeholder="Tìm kiếm bài viết..." 
                                value="{{ request('q') }}"
                                class="medium-search-input"
                            >
                        </div>
                    </form>
                </div>
                
                <!-- Actions -->
                <div class="medium-nav-actions">
                    <a href="{{ route('posts.create') }}" class="medium-btn medium-btn-outline">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Viết bài
                    </a>
                    <a href="{{ route('posts.index') }}" class="medium-btn medium-btn-primary">
                        Khám phá
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="medium-footer">
        <div class="medium-container">
            <div class="medium-footer-content">
                <div class="medium-footer-section">
                    <h4>Khám phá</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('posts.index') }}">Tất cả bài viết</a></li>
                        <li><a href="{{ route('posts.create') }}">Viết bài mới</a></li>
                    </ul>
                </div>
                
                <div class="medium-footer-section">
                    <h4>Danh mục</h4>
                    <ul>
                        @foreach(\App\Models\Category::take(5)->get() as $category)
                        <li><a href="{{ route('posts.by-category', $category) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="medium-footer-section">
                    <h4>Liên kết</h4>
                    <ul>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="medium-footer-bottom">
                <p>&copy; {{ date('Y') }} Medium Clone. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Flash messages
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
        
        @if(session('error'))
            alert('{{ session('error') }}');
        @endif
    </script>
</body>
</html> 