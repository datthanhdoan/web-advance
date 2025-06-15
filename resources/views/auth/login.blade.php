<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign in - Medium</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GT+America:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'GT America', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f7f4ed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(36, 36, 36, 0.1);
            width: 100%;
            max-width: 432px;
            padding: 48px 32px;
            margin: 20px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .auth-logo {
            font-size: 32px;
            font-weight: 700;
            color: #242424;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 24px;
        }

        .auth-title {
            font-size: 28px;
            font-weight: 700;
            color: #242424;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .auth-subtitle {
            font-size: 16px;
            color: #757575;
            line-height: 1.4;
        }

        .auth-form {
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 400;
            color: #242424;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e6e6e6;
            border-radius: 4px;
            font-size: 16px;
            font-family: inherit;
            background: #f7f4ed;
            transition: all 0.15s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #242424;
            background: white;
            box-shadow: 0 0 0 1px #242424;
        }

        .form-input.error {
            border-color: #c5221f;
            background: #fdf2f2;
        }

        .form-input::placeholder {
            color: #a6a6a6;
        }

        .form-error {
            color: #c5221f;
            font-size: 14px;
            margin-top: 4px;
        }

        .status-message {
            background: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 24px 0;
        }

        .form-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #242424;
        }

        .form-checkbox label {
            font-size: 14px;
            color: #757575;
            cursor: pointer;
        }

        .auth-btn {
            width: 100%;
            padding: 12px 16px;
            background: #242424;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.15s ease;
            font-family: inherit;
        }

        .auth-btn:hover {
            background: #1a1a1a;
        }

        .auth-btn:active {
            background: #0f0f0f;
        }

        .auth-divider {
            text-align: center;
            margin: 32px 0 24px;
            position: relative;
            color: #757575;
            font-size: 14px;
        }

        .auth-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e6e6e6;
            z-index: 1;
        }

        .auth-divider span {
            background: white;
            padding: 0 16px;
            position: relative;
            z-index: 2;
        }

        .auth-links {
            text-align: center;
        }

        .auth-link {
            color: #242424;
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .back-link {
            position: absolute;
            top: 24px;
            left: 24px;
            color: #757575;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.15s ease;
        }

        .back-link:hover {
            color: #242424;
        }

        @media (max-width: 768px) {
            .auth-container {
                margin: 0;
                padding: 32px 24px;
                border-radius: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            body {
                background: #f7f4ed;
            }

            .back-link {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 24px;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Về trang chủ
    </a>

    <div class="auth-container">
        <div class="auth-header">
            <a href="{{ route('home') }}" class="auth-logo">Medium</a>
            <h1 class="auth-title">Đăng nhập</h1>
            <p class="auth-subtitle">Chào mừng bạn quay trở lại với Medium</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input 
                    id="email" 
                    class="form-input {{ $errors->get('email') ? 'error' : '' }}" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="Nhập địa chỉ email của bạn"
                />
                @if ($errors->get('email'))
                    <div class="form-error">
                        {{ $errors->get('email')[0] }}
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input 
                    id="password" 
                    class="form-input {{ $errors->get('password') ? 'error' : '' }}"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="Nhập mật khẩu của bạn"
                />
                @if ($errors->get('password'))
                    <div class="form-error">
                        {{ $errors->get('password')[0] }}
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="form-checkbox">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit" class="auth-btn">
                Đăng nhập
            </button>
        </form>

        <div class="auth-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">
                    Quên mật khẩu?
                </a>
            @endif
        </div>

        <div class="auth-divider">
            <span>Chưa có tài khoản?</span>
        </div>

        <div class="auth-links">
            <a href="{{ route('register') }}" class="auth-link">
                Đăng ký ngay
            </a>
        </div>
    </div>
</body>
</html>
