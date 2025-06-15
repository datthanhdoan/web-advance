@extends('layouts.app')

@section('content')
<style>
.profile-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 20px;
}

.profile-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 20px;
    background: linear-gradient(135deg, #1a8917 0%, #156d12 100%);
    border-radius: 16px;
    color: white;
}

.profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 2rem;
    margin: 0 auto 20px;
    border: 4px solid rgba(255, 255, 255, 0.3);
}

.profile-name {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.profile-email {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 20px;
}

.profile-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
}

.profile-stat {
    text-align: center;
}

.profile-stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    display: block;
}

.profile-stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
}

.profile-content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
}

.profile-section {
    background: white;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 30px;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-group {
    margin-bottom: 20px;
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
    padding: 12px 16px;
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

.btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-primary {
    background: #1a8917;
    color: white;
}

.btn-primary:hover {
    background: #156d12;
    color: white;
}

.btn-danger {
    background: #dc2626;
    color: white;
}

.btn-danger:hover {
    background: #b91c1c;
    color: white;
}

.btn-outline {
    background: white;
    color: #6b6b6b;
    border: 1px solid #e6e6e6;
}

.btn-outline:hover {
    background: #f7f7f7;
    color: #1a1a1a;
}

.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 0.875rem;
}

.alert-success {
    background: #e6f7e6;
    color: #1a8917;
    border: 1px solid #c3f0c3;
}

.alert-danger {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.danger-zone {
    border: 2px solid #dc2626;
    border-radius: 12px;
    padding: 20px;
    background: #fef2f2;
}

.danger-zone .section-title {
    color: #dc2626;
}

@media (max-width: 768px) {
    .profile-container {
        padding: 20px 15px;
    }
    
    .profile-stats {
        gap: 20px;
    }
    
    .profile-stat-number {
        font-size: 1.25rem;
    }
}
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <h1 class="profile-name">{{ Auth::user()->name }}</h1>
        <p class="profile-email">{{ Auth::user()->email }}</p>
        
        <div class="profile-stats">
            <div class="profile-stat">
                <span class="profile-stat-number">{{ Auth::user()->posts()->count() }}</span>
                <span class="profile-stat-label">Bài viết</span>
            </div>
            <div class="profile-stat">
                <span class="profile-stat-number">{{ Auth::user()->comments()->count() }}</span>
                <span class="profile-stat-label">Bình luận</span>
            </div>
            <div class="profile-stat">
                <span class="profile-stat-number">{{ Auth::user()->posts()->sum('views') }}</span>
                <span class="profile-stat-label">Lượt xem</span>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="profile-content">
        <!-- Update Profile Information -->
        <div class="profile-section">
            <h2 class="section-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Thông tin cá nhân
            </h2>
            
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success">
                    Thông tin đã được cập nhật thành công!
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="form-input {{ $errors->get('name') ? 'error' : '' }}" 
                        value="{{ old('name', Auth::user()->name) }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                    />
                    @if ($errors->get('name'))
                        <div class="form-error">{{ $errors->get('name')[0] }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="form-input {{ $errors->get('email') ? 'error' : '' }}" 
                        value="{{ old('email', Auth::user()->email) }}" 
                        required 
                        autocomplete="username"
                    />
                    @if ($errors->get('email'))
                        <div class="form-error">{{ $errors->get('email')[0] }}</div>
                    @endif

                    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                        <div class="alert alert-danger" style="margin-top: 10px;">
                            Email chưa được xác thực.
                            <button form="send-verification" class="btn btn-outline" style="margin-left: 10px;">
                                Gửi lại email xác thực
                            </button>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Lưu thay đổi
                </button>
            </form>
        </div>

        <!-- Update Password -->
        <div class="profile-section">
            <h2 class="section-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Đổi mật khẩu
            </h2>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success">
                    Mật khẩu đã được cập nhật thành công!
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                    <input 
                        id="current_password" 
                        name="current_password" 
                        type="password" 
                        class="form-input {{ $errors->updatePassword->get('current_password') ? 'error' : '' }}" 
                        autocomplete="current-password"
                    />
                    @if ($errors->updatePassword->get('current_password'))
                        <div class="form-error">{{ $errors->updatePassword->get('current_password')[0] }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu mới</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        class="form-input {{ $errors->updatePassword->get('password') ? 'error' : '' }}" 
                        autocomplete="new-password"
                    />
                    @if ($errors->updatePassword->get('password'))
                        <div class="form-error">{{ $errors->updatePassword->get('password')[0] }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        class="form-input {{ $errors->updatePassword->get('password_confirmation') ? 'error' : '' }}" 
                        autocomplete="new-password"
                    />
                    @if ($errors->updatePassword->get('password_confirmation'))
                        <div class="form-error">{{ $errors->updatePassword->get('password_confirmation')[0] }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Cập nhật mật khẩu
                </button>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="profile-section danger-zone">
            <h2 class="section-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                Xóa tài khoản
            </h2>

            <p style="color: #6b6b6b; margin-bottom: 20px;">
                Khi bạn xóa tài khoản, tất cả dữ liệu và thông tin sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào bạn muốn giữ lại.
            </p>

            <button 
                type="button" 
                class="btn btn-danger"
                onclick="if(confirm('Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác!')) { document.getElementById('delete-form').submit(); }"
            >
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Xóa tài khoản
            </button>

            <form id="delete-form" method="POST" action="{{ route('profile.destroy') }}" style="display: none;">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>

@if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}" style="display: none;">
        @csrf
    </form>
@endif
@endsection
