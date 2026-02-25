@extends('layouts.app')

@section('title', 'Login - TaskFlow')

@section('content')
<style>
    /* Modern gradient background animation */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Floating animation for the logo */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0px); }
    }
    
    /* Pulse effect for focus states */
    @keyframes gentlePulse {
        0% { box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.1); }
        70% { box-shadow: 0 0 0 10px rgba(0, 0, 0, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 0, 0, 0); }
    }
    
    /* Custom styles */
    .login-container {
        background: linear-gradient(135deg, #b4b7c5 0%, #908c94 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 2.5rem;
        width: 100%;
        max-width: 440px;
        transition: transform 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .login-card:hover {
        transform: translateY(-5px);
    }
    
    .logo-wrapper {
        animation: float 6s ease-in-out infinite;
        display: inline-flex;
        padding: 0.75rem;
        background: linear-gradient(135deg, #878eaa 0%, #8c7e9b 100%);
        border-radius: 1.5rem;
        box-shadow: 0 20px 30px -10px rgba(102, 126, 234, 0.4);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    
    .logo-wrapper:hover {
        transform: scale(1.05) rotate(5deg);
    }
    
    .logo-icon {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 1rem;
        color: #667eea;
        font-size: 1.25rem;
    }
    
    .input-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .input-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 0.5rem;
        margin-left: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .input-field {
        width: 100%;
        padding: 1rem 1.25rem;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 1rem;
        font-size: 0.95rem;
        color: #1a202c;
        transition: all 0.3s ease;
        outline: none;
    }
    
    .input-field:hover {
        background: white;
        border-color: #cbd5e0;
    }
    
    .input-field:focus {
        background: white;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: scale(1.02);
    }
    
    .input-field::placeholder {
        color: #a0aec0;
        font-weight: 300;
    }
    
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 3.5rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a0aec0;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0.5rem;
        border-radius: 0.5rem;
    }
    
    .password-toggle:hover {
        color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }
    
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        cursor: pointer;
    }
    
    .checkbox-wrapper input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 0.375rem;
        border: 2px solid #e2e8f0;
        margin-right: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .checkbox-wrapper input[type="checkbox"]:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    
    .checkbox-wrapper label {
        color: #4a5568;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
    }
    
    .login-button {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 1rem;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.025em;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .login-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .login-button:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 30px -10px rgba(102, 126, 234, 0.5);
    }
    
    .login-button:active {
        transform: translateY(0);
    }
    
    .divider {
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }
    
    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    }
    
    .divider span {
        position: relative;
        background: white;
        padding: 0 1rem;
        color: #718096;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .social-button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 0.875rem;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 1rem;
        color: #1a202c;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
    }
    
    .social-button:hover {
        background: #f7fafc;
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -10px rgba(102, 126, 234, 0.3);
    }
    
    .social-button i {
        color: #667eea;
        font-size: 1.1rem;
    }
    
    .register-link {
        text-align: center;
        margin-top: 2rem;
        color: #718096;
        font-size: 0.95rem;
    }
    
    .register-link a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        margin-left: 0.5rem;
        position: relative;
    }
    
    .register-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .register-link a:hover::after {
        transform: scaleX(1);
    }
    
    .footer-text {
        text-align: center;
        margin-top: 2rem;
        color: #a0aec0;
        font-size: 0.875rem;
        font-style: italic;
        position: relative;
    }
    
    .footer-text::before {
    
        margin-right: 0.5rem;
        opacity: 0.5;
    }
    
    /* Alert animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .alert {
        animation: slideDown 0.5s ease-out;
        border-radius: 1rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-left: 4px solid;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #f0fff4 0%, #e6fffa 100%);
        border-left-color: #48bb78;
        color: #22543d;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
        border-left-color: #f56565;
        color: #742a2a;
    }
    
    .alert i {
        font-size: 1.25rem;
    }
    
    .forgot-link {
        color: #718096;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
    }
    
    .forgot-link:hover {
        color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="text-center">
            <div class="flex justify-center">
                <div class="logo-wrapper">
                    <div class="logo-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back</h1>
            <p class="text-gray-600 text-sm mb-8">Log in to your workspace to continue</p>
        </div>

        @if(session('success') || $errors->any())
            <div class="mb-6">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong class="block mb-1">Invalid credentials</strong>
                            <ul class="text-sm list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email" class="input-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="input-field"
                    placeholder="name@company.com">
            </div>

            <div class="input-group">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="input-label">Password</label>
                    <a href="#" class="forgot-link">Forgot?</a>
                </div>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="input-field pr-12"
                        placeholder="Enter your password">
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="checkbox-wrapper">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me for 30 days</label>
            </div>

            <button type="submit" class="login-button">
                Sign in to account
            </button>
        </form>

        <div class="divider">
            <span>Or continue with</span>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <button class="social-button">
                <i class="fab fa-google"></i>
                Google
            </button>
            <button class="social-button">
                <i class="fab fa-github"></i>
                GitHub
            </button>
        </div>

        <div class="register-link">
            New to TaskFlow?
            <a href="{{ route('register') }}">Create account</a>
        </div>

        <div class="footer-text">
            Built for teams who move fast
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        toggleIcon.className = 'fas fa-eye';
    }
}

// Add focus effects to inputs
document.querySelectorAll('.input-field').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Smooth hover effects for social buttons
document.querySelectorAll('.social-button').forEach(button => {
    button.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    button.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});
</script>
@endsection