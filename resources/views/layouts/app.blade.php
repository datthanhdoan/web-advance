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
    @stack('styles')
    
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
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
        
        .medium-btn-ghost {
            background: transparent;
            color: #6b6b6b;
            border: none;
            padding: 8px 12px;
        }
        
        .medium-btn-ghost:hover {
            background: #f7f7f7;
            color: #1a1a1a;
        }
        
        /* User dropdown */
        .user-dropdown {
            position: relative;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #1a8917;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .user-avatar:hover {
            background: #156d12;
        }
        
        /* Icon styling */
        .medium-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }
        
        .dropdown-item svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            min-width: 250px;
            z-index: 100;
            display: none;
            margin-top: 8px;
            padding: 0;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .user-info {
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-details {
            flex: 1;
        }
        
        .user-name {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 0.875rem;
        }
        
        .user-email {
            color: #6b6b6b;
            font-size: 0.75rem;
            margin-top: 2px;
        }
        
        .dropdown-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 8px 0;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #1a1a1a;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background: #f7f7f7;
        }
        
        .dropdown-item.danger {
            color: #dc2626;
        }
        
        .dropdown-item.danger:hover {
            background: #fef2f2;
        }
        
        /* Notifications */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-width: 400px;
            animation: slideIn 0.3s ease;
        }
        
        .notification.success {
            border-left: 4px solid #1a8917;
        }
        
        .notification.error {
            border-left: 4px solid #dc2626;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
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
                                placeholder="Search" 
                                value="{{ request('q') }}"
                                class="medium-search-input"
                            >
                        </div>
                    </form>
                </div>
                
                <!-- Actions -->
                <div class="medium-nav-actions">
                    @auth
                        <a href="{{ route('posts.create') }}" class="medium-btn medium-btn-ghost" style="color: #6b6b6b;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Write
                        </a>
                        
                        <!-- Notifications -->
                        <button class="medium-btn medium-btn-ghost" onclick="toggleNotifications()" style="color: #6b6b6b;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                            </svg>
                        </button>
                        
                        <!-- User Dropdown -->
                        <div class="user-dropdown">
                            <div class="user-avatar" onclick="toggleUserDropdown()">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="dropdown-menu" id="userDropdown">
                                <div class="user-info">
                                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                                    <div class="user-details">
                                        <div class="user-name">{{ Auth::user()->name }}</div>
                                        <div class="user-email">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('posts.my') }}" class="dropdown-item">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Bài viết của tôi
                                </a>
                                <a href="{{ route('posts.create') }}" class="dropdown-item">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Viết bài mới
                                </a>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Hồ sơ cá nhân
                                </a>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Cài đặt
                                </a>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item danger" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="medium-btn medium-btn-ghost">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}" class="medium-btn medium-btn-primary">
                            Get started
                        </a>
                    @endauth
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

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="notification success" id="notification">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong>Thành công!</strong><br>
                    {{ session('success') }}
                </div>
                <button onclick="closeNotification()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #6b6b6b;">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="notification error" id="notification">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong>Lỗi!</strong><br>
                    {{ session('error') }}
                </div>
                <button onclick="closeNotification()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #6b6b6b;">&times;</button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="notification error" id="notification">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong>Có lỗi xảy ra!</strong><br>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                <button onclick="closeNotification()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #6b6b6b;">&times;</button>
            </div>
        </div>
    @endif

    <!-- Scripts -->
    <script>
        // User dropdown toggle
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Notifications toggle (placeholder)
        function toggleNotifications() {
            alert('Tính năng thông báo sẽ được phát triển trong tương lai!');
        }

        // Close notification
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Auto close notification after 5 seconds
        setTimeout(() => {
            closeNotification();
        }, 5000);

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const avatar = document.querySelector('.user-avatar');
            
            if (dropdown && !dropdown.contains(event.target) && !avatar.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Add slideOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    
    @stack('scripts')
</body>
</html> 