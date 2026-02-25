@extends('layouts.app')

@section('title', 'Register - TaskFlow')

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
    
    /* Shake animation for error states */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
        20%, 40%, 60%, 80% { transform: translateX(2px); }
    }
    
    /* Pulse effect for focus states */
    @keyframes gentlePulse {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }
    
    /* Custom styles */
    .register-container {
        background: linear-gradient(135deg, #b4b7c5 0%, #908c94 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    
    .register-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 2.5rem;
        width: 100%;
        max-width: 480px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .register-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px -12px rgba(102, 126, 234, 0.25);
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
        margin-bottom: 1.25rem;
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
    
    .input-field.error {
        border-color: #f56565;
        animation: shake 0.5s ease-in-out;
    }
    
    .input-field.error:focus {
        border-color: #f56565;
        box-shadow: 0 0 0 4px rgba(245, 101, 101, 0.1);
    }
    
    .input-field::placeholder {
        color: #a0aec0;
        font-weight: 300;
    }
    
    .password-field-wrapper {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a0aec0;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0.5rem;
        border-radius: 0.5rem;
        z-index: 10;
    }
    
    .password-toggle:hover {
        color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }
    
    .password-requirements {
        font-size: 0.75rem;
        color: #718096;
        margin-top: 0.5rem;
        padding-left: 0.5rem;
        font-weight: 600;
        letter-spacing: 0.025em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .password-requirements i {
        color: #667eea;
        font-size: 0.875rem;
    }
    
    .checkbox-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin: 1.5rem 0;
        cursor: pointer;
    }
    
    .checkbox-wrapper input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 0.375rem;
        border: 2px solid #e2e8f0;
        margin-top: 0.125rem;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    
    .checkbox-wrapper input[type="checkbox"]:checked {
        background-color: #667eea;
        border-color: #667eea;
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        background-size: 100%;
        background-position: center;
        background-repeat: no-repeat;
    }
    
    .checkbox-wrapper label {
        color: #4a5568;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        line-height: 1.5;
    }
    
    .checkbox-wrapper a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        position: relative;
    }
    
    .checkbox-wrapper a::after {
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
    
    .checkbox-wrapper a:hover::after {
        transform: scaleX(1);
    }
    
    .register-button {
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
    
    .register-button::before {
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
    
    .register-button:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .register-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 30px -10px rgba(102, 126, 234, 0.5);
    }
    
    .register-button:active {
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
    
    .signin-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 1rem;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 1rem;
        color: #1a202c;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .signin-button:hover {
        background: #f7fafc;
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -10px rgba(102, 126, 234, 0.3);
        color: #667eea;
    }
    
    .signin-button i {
        margin-right: 0.5rem;
        transition: transform 0.3s ease;
    }
    
    .signin-button:hover i {
        transform: translateX(-3px);
    }
    
    .footer-text {
        text-align: center;
        margin-top: 2.5rem;
        color: #a0aec0;
        font-size: 0.875rem;
        font-style: italic;
        position: relative;
    }
    
    .footer-text::before {
       
        margin-right: 0.5rem;
        opacity: 0.5;
    }
    
    .footer-text::after {
        
        margin-left: 0.5rem;
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
        border-left: 4px solid;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
        border-left-color: #f56565;
        color: #742a2a;
    }
    
    .alert i {
        font-size: 1.25rem;
        margin-right: 0.5rem;
    }
    
    .alert ul {
        margin-top: 0.5rem;
        margin-left: 1.5rem;
        opacity: 0.8;
    }
    
    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    /* Password strength indicator */
    .password-strength {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        margin-top: 0.5rem;
        overflow: hidden;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: all 0.3s ease;
    }
    
    .strength-weak { background: #f56565; width: 33.33%; }
    .strength-medium { background: #ecc94b; width: 66.66%; }
    .strength-strong { background: #48bb78; width: 100%; }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .register-card {
            padding: 1.5rem;
        }
        
        .grid-2 {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="text-center">
            <div class="flex justify-center">
                <div class="logo-wrapper">
                    <div class="logo-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create account</h1>
            <p class="text-gray-600 text-sm mb-8">Join TaskFlow and start organizing today</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <div class="flex items-start gap-2">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <div>
                        <strong class="block mb-1">Action required</strong>
                        <ul class="text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="input-group">
                <label for="name" class="input-label">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                    class="input-field @error('name') error @enderror"
                    placeholder="John Doe">
            </div>

            <div class="input-group">
                <label for="email" class="input-label">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="input-field @error('email') error @enderror"
                    placeholder="name@company.com">
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="password" class="input-label">Password</label>
                    <div class="password-field-wrapper">
                        <input type="password" id="password" name="password" required
                            class="input-field @error('password') error @enderror"
                            placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="input-group">
                    <label for="password_confirmation" class="input-label">Confirm</label>
                    <div class="password-field-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="input-field"
                            placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Password strength indicator -->
            <div class="password-strength">
                <div class="password-strength-bar" id="passwordStrength"></div>
            </div>

            <div class="password-requirements">
                <i class="fas fa-shield-alt"></i>
                <span>Minimum 8 characters with a mix of symbols & numbers</span>
            </div>

            <div class="checkbox-wrapper">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="register-button">
                Create your account
            </button>
        </form>

        <div class="divider">
            <span>Already a member?</span>
        </div>

        <a href="{{ route('login') }}" class="signin-button">
            <i class="fas fa-arrow-left"></i>
            Sign in to your account
        </a>

        <div class="footer-text">
            Simplify your workflow
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const toggleBtn = event.currentTarget;
    const icon = toggleBtn.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Password strength checker
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('passwordStrength');
    
    // Remove existing classes
    strengthBar.className = 'password-strength-bar';
    
    if (password.length === 0) {
        strengthBar.style.width = '0';
        return;
    }
    
    // Check password strength
    let strength = 0;
    
    // Length check
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    
    // Character variety checks
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;
    
    // Apply strength class
    if (strength <= 3) {
        strengthBar.classList.add('strength-weak');
    } else if (strength <= 5) {
        strengthBar.classList.add('strength-medium');
    } else {
        strengthBar.classList.add('strength-strong');
    }
});

// Real-time password confirmation matching
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirm = this.value;
    
    if (confirm.length > 0) {
        if (password === confirm) {
            this.classList.remove('error');
            this.style.borderColor = '#48bb78';
        } else {
            this.classList.add('error');
            this.style.borderColor = '#f56565';
        }
    } else {
        this.classList.remove('error');
        this.style.borderColor = '#e2e8f0';
    }
});

// Form validation before submit
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;
    const terms = document.getElementById('terms').checked;
    
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match!');
        return;
    }
    
    if (!terms) {
        e.preventDefault();
        alert('Please agree to the Terms of Service and Privacy Policy');
        return;
    }
});

// Add focus effects
document.querySelectorAll('.input-field').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Smooth hover effects for buttons
document.querySelectorAll('.signin-button').forEach(button => {
    button.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    button.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});
</script>
@endsection