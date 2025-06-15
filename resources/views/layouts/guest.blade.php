<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                padding: 20px;
            }
            
            .auth-container {
                background: white;
                border-radius: 16px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                width: 100%;
                max-width: 900px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                min-height: 600px;
            }
            
            .auth-left {
                background: linear-gradient(135deg, #1a8917 0%, #156d12 100%);
                padding: 60px 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                color: white;
                position: relative;
                overflow: hidden;
            }
            
            .auth-left::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 200%;
                height: 200%;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="50" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                animation: float 20s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(180deg); }
            }
            
            .auth-logo {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 20px;
                position: relative;
                z-index: 1;
            }
            
            .auth-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 15px;
                position: relative;
                z-index: 1;
            }
            
            .auth-subtitle {
                font-size: 1rem;
                opacity: 0.9;
                line-height: 1.6;
                position: relative;
                z-index: 1;
            }
            
            .auth-right {
                padding: 60px 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            
            .auth-form-title {
                font-size: 2rem;
                font-weight: 700;
                color: #1a1a1a;
                margin-bottom: 8px;
                text-align: center;
            }
            
            .auth-form-subtitle {
                color: #6b6b6b;
                text-align: center;
                margin-bottom: 40px;
                font-size: 1rem;
            }
            
            .form-group {
                margin-bottom: 24px;
            }
            
            .form-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 8px;
            }
            
            .form-input {
                width: 100%;
                padding: 14px 16px;
                border: 2px solid #e6e6e6;
                border-radius: 8px;
                font-size: 1rem;
                transition: all 0.2s ease;
                outline: none;
                background: #fafafa;
            }
            
            .form-input:focus {
                border-color: #1a8917;
                background: white;
                box-shadow: 0 0 0 3px rgba(26, 137, 23, 0.1);
            }
            
            .form-input.error {
                border-color: #dc2626;
                background: #fef2f2;
            }
            
            .form-error {
                color: #dc2626;
                font-size: 0.875rem;
                margin-top: 6px;
            }
            
            .form-checkbox {
                display: flex;
                align-items: center;
                gap: 8px;
                margin: 20px 0;
            }
            
            .form-checkbox input {
                width: 18px;
                height: 18px;
                accent-color: #1a8917;
            }
            
            .form-checkbox label {
                font-size: 0.875rem;
                color: #6b6b6b;
                cursor: pointer;
            }
            
            .auth-btn {
                width: 100%;
                padding: 14px 24px;
                background: #1a8917;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
                margin-bottom: 20px;
            }
            
            .auth-btn:hover {
                background: #156d12;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(26, 137, 23, 0.3);
            }
            
            .auth-btn:active {
                transform: translateY(0);
            }
            
            .auth-links {
                text-align: center;
                margin-top: 20px;
            }
            
            .auth-link {
                color: #1a8917;
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 500;
                transition: color 0.2s ease;
            }
            
            .auth-link:hover {
                color: #156d12;
                text-decoration: underline;
            }
            
            .auth-divider {
                text-align: center;
                margin: 20px 0;
                color: #6b6b6b;
                font-size: 0.875rem;
            }
            
            .back-to-home {
                position: absolute;
                top: 20px;
                left: 20px;
                color: white;
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 500;
                padding: 8px 16px;
                border-radius: 20px;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                transition: all 0.2s ease;
                z-index: 10;
            }
            
            .back-to-home:hover {
                background: rgba(255, 255, 255, 0.2);
                color: white;
            }
            
            /* Responsive */
            @media (max-width: 768px) {
                body {
                    padding: 10px;
                }
                
                .auth-container {
                    grid-template-columns: 1fr;
                    max-width: 400px;
                }
                
                .auth-left {
                    padding: 40px 30px;
                    text-align: center;
                }
                
                .auth-right {
                    padding: 40px 30px;
                }
                
                .auth-logo {
                    font-size: 2rem;
                }
                
                .auth-title {
                    font-size: 1.25rem;
                }
                
                .auth-form-title {
                    font-size: 1.5rem;
                }
            }
            
            /* Status messages */
            .status-message {
                background: #e6f7e6;
                color: #1a8917;
                padding: 12px 16px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 0.875rem;
                border: 1px solid #c3f0c3;
            }
        </style>
    </head>
    <body>
        <a href="{{ route('home') }}" class="back-to-home">
            ← Về trang chủ
        </a>
        
        <div class="auth-container">
            <div class="auth-left">
                <div class="auth-logo">Medium</div>
                <h1 class="auth-title">Chào mừng trở lại!</h1>
                <p class="auth-subtitle">
                    Khám phá những câu chuyện thú vị, chia sẻ kiến thức và kết nối với cộng đồng những người yêu thích viết lách.
                </p>
            </div>
            
            <div class="auth-right">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
