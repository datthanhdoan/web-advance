@extends('layouts.app')

@section('content')
<style>
.settings-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 80px;
}

.settings-sidebar {
    position: sticky;
    top: 100px;
    height: fit-content;
}

.settings-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.settings-nav-item {
    margin-bottom: 4px;
}

.settings-nav-link {
    display: block;
    padding: 12px 0;
    color: #6b6b6b;
    text-decoration: none;
    font-size: 16px;
    font-weight: 400;
    transition: color 0.2s ease;
    border-bottom: 1px solid transparent;
}

.settings-nav-link:hover,
.settings-nav-link.active {
    color: #1a1a1a;
}

.settings-nav-link.active {
    border-bottom-color: #1a1a1a;
}

.settings-main {
    max-width: 680px;
}

.settings-header {
    margin-bottom: 48px;
}

.settings-title {
    font-size: 42px;
    font-weight: 400;
    color: #1a1a1a;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

.settings-subtitle {
    font-size: 16px;
    color: #6b6b6b;
    margin: 0;
    line-height: 1.4;
}

.settings-section {
    margin-bottom: 64px;
}

.section-title {
    font-size: 20px;
    font-weight: 500;
    color: #1a1a1a;
    margin: 0 0 32px 0;
    line-height: 1.3;
}

.form-row {
    margin-bottom: 32px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #1a1a1a;
    margin-bottom: 8px;
    line-height: 1.4;
}

.form-input {
    width: 100%;
    padding: 12px 0;
    border: none;
    border-bottom: 1px solid #e6e6e6;
    font-size: 16px;
    color: #1a1a1a;
    background: transparent;
    outline: none;
    transition: border-color 0.2s ease;
}

.form-input:focus {
    border-bottom-color: #1a1a1a;
}

.form-input::placeholder {
    color: #a3a3a3;
}

.form-help {
    font-size: 14px;
    color: #6b6b6b;
    margin-top: 8px;
    line-height: 1.4;
}

.form-error {
    font-size: 14px;
    color: #dc2626;
    margin-top: 8px;
    line-height: 1.4;
}

.btn {
    padding: 8px 16px;
    border: 1px solid #1a1a1a;
    border-radius: 20px;
    background: transparent;
    color: #1a1a1a;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.btn:hover {
    background: #1a1a1a;
    color: white;
}

.btn-primary {
    background: #1a8917;
    border-color: #1a8917;
    color: white;
}

.btn-primary:hover {
    background: #156d12;
    border-color: #156d12;
    color: white;
}

.btn-danger {
    border-color: #dc2626;
    color: #dc2626;
}

.btn-danger:hover {
    background: #dc2626;
    color: white;
}

.alert {
    padding: 16px 20px;
    border-radius: 4px;
    margin-bottom: 24px;
    font-size: 14px;
    line-height: 1.4;
}

.alert-success {
    background: #f0f9f0;
    color: #1a8917;
    border: 1px solid #c3f0c3;
}

.profile-info {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px 0;
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 32px;
}

.profile-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #1a8917;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 24px;
}

.profile-details h3 {
    font-size: 20px;
    font-weight: 500;
    color: #1a1a1a;
    margin: 0 0 4px 0;
}

.profile-details p {
    font-size: 14px;
    color: #6b6b6b;
    margin: 0;
}

.danger-zone {
    border-top: 1px solid #f0f0f0;
    padding-top: 48px;
    margin-top: 64px;
}

.danger-zone .section-title {
    color: #dc2626;
}

.danger-zone .form-help {
    color: #dc2626;
}

@media (max-width: 768px) {
    .settings-container {
        grid-template-columns: 1fr;
        gap: 40px;
        padding: 40px 20px;
    }
    
    .settings-sidebar {
        position: static;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 24px;
    }
    
    .settings-nav {
        display: flex;
        gap: 24px;
        overflow-x: auto;
        padding-bottom: 8px;
    }
    
    .settings-nav-item {
        margin-bottom: 0;
        white-space: nowrap;
    }
    
    .settings-title {
        font-size: 32px;
    }
}
</style>

<div class="settings-container">
    <!-- Sidebar Navigation -->
    <div class="settings-sidebar">
        <nav>
            <ul class="settings-nav">
                <li class="settings-nav-item">
                    <a href="#account" class="settings-nav-link active">Account</a>
                </li>
                <li class="settings-nav-item">
                    <a href="#publishing" class="settings-nav-link">Publishing</a>
                </li>
                <li class="settings-nav-item">
                    <a href="#notifications" class="settings-nav-link">Notifications</a>
                </li>
                <li class="settings-nav-item">
                    <a href="#membership" class="settings-nav-link">Membership and payment</a>
                </li>
                <li class="settings-nav-item">
                    <a href="#security" class="settings-nav-link">Security and apps</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="settings-main">
        <!-- Header -->
        <div class="settings-header">
            <h1 class="settings-title">Settings</h1>
        </div>

        <!-- Profile Info -->
        <div class="profile-info">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="profile-details">
                <h3>{{ Auth::user()->name }}</h3>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Email Address -->
        <div class="settings-section">
            <h2 class="section-title">Email address</h2>
            
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success">
                    Profile information updated successfully.
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-row">
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="form-input" 
                        value="{{ old('email', Auth::user()->email) }}" 
                        required 
                        autocomplete="username"
                        placeholder="your@email.com"
                    />
                    @if ($errors->get('email'))
                        <div class="form-error">{{ $errors->get('email')[0] }}</div>
                    @endif
                    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                        <div class="form-help" style="color: #dc2626;">
                            Your email address is unverified. 
                            <button form="send-verification" class="btn" style="margin-left: 8px; padding: 4px 12px; font-size: 12px;">
                                Resend verification email
                            </button>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <!-- Username and subdomain -->
        <div class="settings-section">
            <h2 class="section-title">Username and subdomain</h2>
            
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-row">
                    <label for="name" class="form-label">Username</label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="form-input" 
                        value="{{ old('name', Auth::user()->name) }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Your display name"
                    />
                    @if ($errors->get('name'))
                        <div class="form-error">{{ $errors->get('name')[0] }}</div>
                    @endif
                    <div class="form-help">
                        @{{ strtolower(str_replace(' ', '', Auth::user()->name)) }}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <!-- Profile information -->
        <div class="settings-section">
            <h2 class="section-title">Profile information</h2>
            <div class="form-help" style="margin-bottom: 24px;">
                Edit your photo, name, pronouns, short bio, etc.
            </div>
            <button type="button" class="btn">Edit profile</button>
        </div>

        <!-- Profile design -->
        <div class="settings-section">
            <h2 class="section-title">Profile design</h2>
            <div class="form-help" style="margin-bottom: 24px;">
                Customize the appearance of your profile.
            </div>
            <button type="button" class="btn">Customize</button>
        </div>

        <!-- Custom domain -->
        <div class="settings-section">
            <h2 class="section-title">Custom domain</h2>
            <div class="form-help" style="margin-bottom: 24px;">
                Upgrade to a Medium Membership to redirect your profile URL to a domain like yourdomain.com.
            </div>
            <div style="color: #6b6b6b; font-size: 16px;">None</div>
        </div>

        <!-- Change Password -->
        <div class="settings-section">
            <h2 class="section-title">Password</h2>
            
            @if (session('status') === 'password-updated')
                <div class="alert alert-success">
                    Password updated successfully.
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-row">
                    <label for="current_password" class="form-label">Current password</label>
                    <input 
                        id="current_password" 
                        name="current_password" 
                        type="password" 
                        class="form-input" 
                        autocomplete="current-password"
                        placeholder="Enter current password"
                    />
                    @if ($errors->updatePassword->get('current_password'))
                        <div class="form-error">{{ $errors->updatePassword->get('current_password')[0] }}</div>
                    @endif
                </div>

                <div class="form-row">
                    <label for="password" class="form-label">New password</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        class="form-input" 
                        autocomplete="new-password"
                        placeholder="Enter new password"
                    />
                    @if ($errors->updatePassword->get('password'))
                        <div class="form-error">{{ $errors->updatePassword->get('password')[0] }}</div>
                    @endif
                </div>

                <div class="form-row">
                    <label for="password_confirmation" class="form-label">Confirm new password</label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        class="form-input" 
                        autocomplete="new-password"
                        placeholder="Confirm new password"
                    />
                    @if ($errors->updatePassword->get('password_confirmation'))
                        <div class="form-error">{{ $errors->updatePassword->get('password_confirmation')[0] }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Change password</button>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="danger-zone">
            <div class="settings-section">
                <h2 class="section-title">Delete account</h2>
                <div class="form-help" style="margin-bottom: 24px;">
                    Permanently delete your account and all of your content. This action cannot be undone.
                </div>

                <button 
                    type="button" 
                    class="btn btn-danger"
                    onclick="if(confirm('Are you sure you want to delete your account? This action cannot be undone!')) { document.getElementById('delete-form').submit(); }"
                >
                    Delete account
                </button>

                <form id="delete-form" method="POST" action="{{ route('profile.destroy') }}" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>

@if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}" style="display: none;">
        @csrf
    </form>
@endif

<script>
// Simple tab navigation
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.settings-nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
        });
    });
});
</script>
@endsection
