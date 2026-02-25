@extends('layouts.app')

@section('title', 'Account Settings - TaskFlow')

@push('styles')
<style>
/* =========== SETTINGS PAGE STYLES - IMPROVED AESTHETICS =========== */
:root {
    --gradient-primary: linear-gradient(135deg, var(--blue-500), var(--emerald-500));
    --gradient-dark: linear-gradient(135deg, var(--slate-800), var(--slate-900));
    --shadow-elevation: 0 10px 40px -10px rgba(0, 0, 0, 0.2);
    --shadow-elevation-hover: 0 20px 50px -15px rgba(0, 0, 0, 0.3);
    --border-glow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

.settings-page {
    min-height: 100vh;
    background: radial-gradient(circle at 0% 0%, var(--slate-50) 0%, #ffffff 100%);
    position: relative;
    isolation: isolate;
}

.settings-page::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 100% 100%, rgba(59, 130, 246, 0.03) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.settings-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem 1.5rem 4rem;
    position: relative;
    z-index: 1;
}

/* ===== ANIMATIONS ===== */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

.animate-in {
    animation: slideInUp 0.5s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
}

/* ===== SETTINGS HEADER ===== */
.settings-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
    animation: slideInUp 0.5s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
}

.settings-title-group h1 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--slate-900);
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
    position: relative;
    display: inline-block;
}

.settings-title-group h1::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 60px;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
}

.settings-title-group p {
    color: var(--slate-600);
    font-size: 1rem;
    line-height: 1.5;
    max-width: 500px;
}

.settings-header-actions a {
    text-decoration: none;
}

.settings-header-actions .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 14px;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 2px solid transparent;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    background: var(--white);
    color: var(--slate-700);
    border-color: var(--slate-300);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.settings-header-actions .btn:hover {
    border-color: var(--slate-900);
    background: var(--white);
    color: var(--slate-900);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 12px 25px -8px rgba(0, 0, 0, 0.15);
}

.settings-header-actions .btn i {
    font-size: 0.875rem;
    transition: transform 0.3s ease;
}

.settings-header-actions .btn:hover i {
    transform: translateX(-4px);
}

/* ===== SETTINGS GRID ===== */
.settings-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.75rem;
    margin-top: 1rem;
}

@media (min-width: 768px) {
    .settings-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

/* ===== SETTINGS CARDS ===== */
.settings-card {
    background: var(--white);
    border-radius: 28px;
    border: 1px solid rgba(226, 232, 240, 0.6);
    padding: 2rem;
    box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    backdrop-filter: blur(10px);
    animation: slideInUp 0.5s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
}

.settings-card:nth-child(1) { animation-delay: 0.1s; }
.settings-card:nth-child(2) { animation-delay: 0.2s; }

.settings-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.4s ease, width 0.4s ease;
}

.settings-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.02), rgba(16, 185, 129, 0.02));
    pointer-events: none;
    z-index: 0;
}

.settings-card:hover {
    box-shadow: var(--shadow-elevation-hover);
    transform: translateY(-6px) scale(1.02);
    border-color: rgba(59, 130, 246, 0.2);
}

.settings-card:hover::before {
    opacity: 1;
    width: 6px;
}

.settings-card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.settings-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
    border: 1px solid rgba(59, 130, 246, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-600);
    flex-shrink: 0;
    font-size: 1.25rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
}

.settings-card:hover .settings-icon {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(16, 185, 129, 0.15));
    transform: rotate(5deg) scale(1.1);
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 10px 20px -8px rgba(59, 130, 246, 0.3);
}

.settings-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--slate-900);
    margin-bottom: 0.25rem;
    letter-spacing: -0.01em;
}

.settings-card-subtitle {
    font-size: 0.875rem;
    color: var(--slate-500);
    line-height: 1.5;
}

/* ===== FORM STYLES ===== */
.form-group {
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--slate-800);
    margin-bottom: 0.625rem;
    padding-left: 1rem;
    position: relative;
    letter-spacing: 0.01em;
}

.form-label::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 16px;
    background: var(--gradient-primary);
    border-radius: 2px;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
}

.form-label.required::after {
    content: '*';
    color: #ef4444;
    margin-left: 0.25rem;
    font-weight: 700;
}

.form-control {
    width: 100%;
    padding: 0.9375rem 1.125rem;
    border-radius: 16px;
    border: 2px solid var(--slate-200);
    background: var(--white);
    font-size: 0.9375rem;
    color: var(--slate-900);
    outline: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
}

.form-control:hover {
    border-color: var(--slate-300);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.form-control:focus {
    border-color: var(--blue-500);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15),
                0 4px 12px rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

.form-control.is-invalid {
    border-color: #ef4444;
    background: rgba(254, 226, 226, 0.1);
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.form-control.is-invalid:focus {
    border-color: #dc2626;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
}

.form-text {
    display: block;
    font-size: 0.8125rem;
    color: var(--slate-500);
    margin-top: 0.5rem;
    padding-left: 1rem;
    line-height: 1.5;
}

.form-text.error {
    color: #b91c1c;
    background: linear-gradient(to right, #fee2e2, rgba(254, 226, 226, 0.5));
    border-radius: 12px;
    padding: 0.625rem 1rem;
    border-left: 4px solid #ef4444;
    margin-top: 0.625rem;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-text.error::before {
    content: '⚠';
    font-size: 0.875rem;
    line-height: 1;
}

/* ===== INPUT GROUP ===== */
.input-group {
    position: relative;
}

.input-group .form-control {
    padding-right: 3rem;
}

.password-toggle {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 12px;
    background: var(--white);
    border: 2px solid var(--slate-200);
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--slate-600);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
}

.password-toggle:hover {
    background: var(--slate-100);
    border-color: var(--slate-400);
    color: var(--slate-900);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.password-toggle:active {
    transform: translateY(-50%) scale(0.95);
}

/* ===== CARD FOOTER ===== */
.card-footer {
    margin-top: 2rem;
    display: flex;
    justify-content: flex-end;
    position: relative;
    z-index: 1;
    padding-top: 0.5rem;
    border-top: 2px solid rgba(226, 232, 240, 0.4);
}

.card-footer .btn {
    padding: 0.875rem 2rem;
    border-radius: 14px;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    position: relative;
    overflow: hidden;
    letter-spacing: 0.01em;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.card-footer .btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.card-footer .btn:hover::before {
    transform: translateX(100%);
}

.card-footer .btn-primary {
    background: var(--gradient-dark);
    color: var(--white);
    box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.3);
}

.card-footer .btn-primary:hover {
    background: linear-gradient(135deg, var(--slate-900), #0f172a);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.4);
}

.card-footer .btn-primary:active {
    transform: translateY(-2px) scale(1.02);
}

.card-footer .btn-primary i {
    font-size: 0.875rem;
    transition: transform 0.3s ease;
}

.card-footer .btn-primary:hover i {
    transform: translateX(-2px);
}

/* ===== ALERT STYLES ===== */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    animation: fadeInScale 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(10px);
}

.alert::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    animation: shimmer 2s infinite;
}

.alert-success {
    background: linear-gradient(105deg, #ecfdf5 0%, #d1fae5 100%);
    color: #065f46;
    border-left: 6px solid #10b981;
}

.alert-error {
    background: linear-gradient(105deg, #fef2f2 0%, #fee2e2 100%);
    color: #b91c1c;
    border-left: 6px solid #ef4444;
}

.alert i {
    font-size: 1.25rem;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

/* ===== BUTTON STYLES ===== */
.btn {
    padding: 0.875rem 1.75rem;
    border-radius: 14px;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    letter-spacing: 0.01em;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn:hover::before {
    transform: translateX(100%);
}

.btn-primary {
    background: var(--gradient-dark);
    color: var(--white);
    box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--slate-900), #0f172a);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.4);
}

.btn-primary:active {
    transform: translateY(-2px) scale(1.02);
}

.btn-outline {
    background: transparent;
    color: var(--slate-700);
    border: 2px solid rgba(203, 213, 225, 0.8);
    box-shadow: none;
}

.btn-outline:hover {
    border-color: var(--slate-900);
    background: var(--white);
    color: var(--slate-900);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 12px 25px -8px rgba(0, 0, 0, 0.15);
}

/* ===== LOADING STATES ===== */
.btn.loading {
    position: relative;
    color: transparent !important;
    pointer-events: none;
}

.btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: var(--white);
    animation: spin 0.8s linear infinite;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

/* ===== RESPONSIVE STYLES ===== */
@media (max-width: 768px) {
    .settings-container {
        padding: 1.5rem 1rem 3rem;
    }

    .settings-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .settings-title-group h1 {
        font-size: 1.75rem;
    }

    .settings-title-group p {
        font-size: 0.9375rem;
    }

    .settings-header-actions {
        width: 100%;
    }

    .settings-header-actions .btn {
        width: 100%;
        justify-content: center;
    }

    .settings-card {
        padding: 1.5rem;
    }

    .settings-card-header {
        gap: 0.875rem;
    }

    .settings-icon {
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1rem;
    }

    .settings-card-title {
        font-size: 1.125rem;
    }

    .settings-card-subtitle {
        font-size: 0.8125rem;
    }

    .form-label {
        font-size: 0.8125rem;
        padding-left: 0.875rem;
    }

    .form-control {
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        border-radius: 14px;
    }

    .password-toggle {
        width: 32px;
        height: 32px;
    }

    .card-footer {
        margin-top: 1.5rem;
    }

    .card-footer .btn {
        width: 100%;
        justify-content: center;
        padding: 0.875rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .settings-container {
        padding: 1rem 0.75rem 2.5rem;
    }

    .settings-header {
        padding: 0 0.25rem;
    }

    .settings-title-group h1 {
        font-size: 1.5rem;
    }

    .settings-card {
        padding: 1.25rem;
    }

    .settings-icon {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 14px;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .alert {
        padding: 0.875rem 1.25rem;
        border-radius: 16px;
    }
}

/* ===== CUSTOM TOAST FOR SETTINGS PAGE ===== */
.custom-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    border-radius: 20px;
    background: var(--white);
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.3);
    z-index: 9999;
    transform: translateX(120%);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    max-width: 350px;
    border-left: 6px solid transparent;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.custom-toast.show {
    transform: translateX(0);
}

.toast-success {
    border-left-color: #10b981;
    color: #065f46;
}

.toast-error {
    border-left-color: #ef4444;
    color: #b91c1c;
}

.toast-info {
    border-left-color: #3b82f6;
    color: #1e40af;
}

.toast-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.toast-content i {
    font-size: 1.25rem;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

/* ===== DIVIDER STYLES ===== */
.settings-divider {
    margin: 2rem 0;
    border: none;
    height: 2px;
    background: linear-gradient(90deg, 
        transparent 0%, 
        var(--slate-200) 20%, 
        var(--slate-200) 80%, 
        transparent 100%);
}
</style>
@endpush

@section('content')
<div class="settings-page">
    <div class="settings-container">
        <div class="settings-header">
            <div class="settings-title-group">
                <h1>Account Settings</h1>
                <p>Manage your login details and keep your account secure.</p>
            </div>
            <div class="settings-header-actions">
                <a href="{{ route('profile.show') }}">
                    <button type="button" class="btn btn-outline">
                        <i class="fas fa-user-circle"></i>
                        Back to Profile
                    </button>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="settings-grid">
            <!-- Email Settings -->
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <div class="settings-card-title">Email Address</div>
                        <div class="settings-card-subtitle">Update the email you use to sign in.</div>
                    </div>
                </div>

                <form action="{{ route('settings.update-email') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label required">New Email Address</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email')
                            <small class="form-text error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            placeholder="Confirm with your current password"
                            required
                        >
                        @error('current_password')
                            <small class="form-text error">{{ $message }}</small>
                        @enderror
                        <small class="form-text">We require your current password before changing your email.</small>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Email
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Settings -->
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <div class="settings-card-title">Password</div>
                        <div class="settings-card-subtitle">Change your password to keep your account safe.</div>
                    </div>
                </div>

                <form action="{{ route('settings.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label required">Current Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                id="currentPassword"
                                name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Enter your current password"
                                required
                            >
                            <button type="button" class="password-toggle" data-target="currentPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <small class="form-text error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">New Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                id="newPassword"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Choose a strong password"
                                required
                            >
                            <button type="button" class="password-toggle" data-target="newPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="form-text error">{{ $message }}</small>
                        @enderror
                        <small class="form-text">Minimum 8 characters. Use a mix of letters, numbers, and symbols.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Confirm New Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                id="confirmPassword"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Re-type your new password"
                                required
                            >
                            <button type="button" class="password-toggle" data-target="confirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.password-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetId = btn.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = btn.querySelector('i');

                if (!input) {
                    return;
                }

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>
@endpush

