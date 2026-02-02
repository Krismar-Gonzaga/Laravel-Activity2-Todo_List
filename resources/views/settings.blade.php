@extends('layouts.app')

@section('title', 'Account Settings - TaskFlow')

@push('styles')
<style>
    .settings-page {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--slate-50) 0%, #ffffff 100%);
    }

    .settings-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1.5rem 3rem;
    }

    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .settings-title-group h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--slate-900);
        margin-bottom: 0.25rem;
    }

    .settings-title-group p {
        color: var(--slate-600);
        font-size: 0.95rem;
    }

    .settings-header-actions a {
        text-decoration: none;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .settings-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .settings-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 2px solid var(--slate-100);
        padding: 1.75rem;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .settings-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--blue-500), var(--emerald-500));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .settings-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-4px);
        border-color: var(--slate-200);
    }

    .settings-card:hover::before {
        opacity: 1;
    }

    .settings-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .settings-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: var(--radius);
        background: linear-gradient(135deg, var(--blue-50), var(--emerald-50));
        border: 2px solid var(--blue-100);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-600);
        flex-shrink: 0;
    }

    .settings-card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--slate-900);
    }

    .settings-card-subtitle {
        font-size: 0.85rem;
        color: var(--slate-500);
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--slate-700);
        margin-bottom: 0.5rem;
        padding-left: 0.5rem;
        position: relative;
    }

    .form-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 16px;
        background: var(--blue-500);
        border-radius: 2px;
    }

    .form-label.required::after {
        content: '*';
        color: var(--red-500);
        margin-left: 0.25rem;
    }

    .form-control {
        width: 100%;
        padding: 0.85rem 1rem;
        border-radius: var(--radius);
        border: 2px solid var(--slate-200);
        background: var(--white);
        font-size: 0.9375rem;
        color: var(--slate-900);
        outline: none;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--black);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08);
    }

    .form-control.is-invalid {
        border-color: var(--red-500);
        background: var(--red-50);
    }

    .form-text {
        display: block;
        font-size: 0.8rem;
        color: var(--slate-500);
        margin-top: 0.25rem;
        padding-left: 0.5rem;
    }

    .form-text.error {
        color: var(--red-600);
        background: var(--red-50);
        border-radius: var(--radius-sm);
        padding: 0.45rem 0.75rem;
        border-left: 3px solid var(--red-500);
        margin-top: 0.4rem;
    }

    .card-footer {
        margin-top: 1.25rem;
        display: flex;
        justify-content: flex-end;
    }

    .btn {
        padding: 0.75rem 1.4rem;
        border-radius: var(--radius);
        font-size: 0.9rem;
        font-weight: 500;
        border: 2px solid transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--black) 0%, var(--slate-800) 100%);
        color: var(--white);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--slate-800) 0%, var(--slate-900) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-outline {
        background: var(--white);
        color: var(--slate-700);
        border-color: var(--slate-300);
    }

    .btn-outline:hover {
        border-color: var(--black);
        background: var(--slate-50);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .input-group {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        border-radius: var(--radius-sm);
        background: var(--slate-100);
        border: 1px solid var(--slate-200);
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--slate-600);
        transition: var(--transition);
    }

    .password-toggle:hover {
        background: var(--slate-200);
        border-color: var(--slate-300);
        color: var(--slate-900);
    }

    .alert {
        padding: 0.9rem 1.25rem;
        border-radius: var(--radius);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        border: 2px solid transparent;
    }

    .alert-success {
        background: linear-gradient(135deg, var(--emerald-50), #d1fae5);
        border-color: var(--emerald-200);
        color: var(--emerald-700);
    }

    .alert-error {
        background: linear-gradient(135deg, var(--red-50), #fee2e2);
        border-color: var(--red-200);
        color: var(--red-700);
    }

    .alert i {
        font-size: 1.1rem;
    }

    @media (max-width: 640px) {
        .settings-container {
            padding: 1.5rem 1rem 2.5rem;
        }

        .settings-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .settings-header-actions a .btn {
            width: 100%;
            justify-content: center;
        }
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

