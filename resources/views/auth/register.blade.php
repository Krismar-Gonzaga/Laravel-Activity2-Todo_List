@extends('layouts.app')

@section('title', 'Register - TaskFlow')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center p-6 bg-white selection:bg-black selection:text-white">
    <div class="w-full max-w-[420px]">
        
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-black mb-6 shadow-xl shadow-black/10">
                <i class="fas fa-user-plus text-white text-lg"></i>
            </div>
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Create account</h1>
            <p class="mt-2 text-slate-500 font-medium">Join TaskFlow and start organizing today.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 animate-in fade-in slide-in-from-top-2 duration-500">
                <div class="p-4 rounded-xl bg-red-50 border border-red-100 text-red-800 text-sm">
                    <div class="flex items-center gap-2 mb-1 font-semibold">
                        <i class="fas fa-circle-exclamation"></i> Action required
                    </div>
                    <ul class="opacity-80 ml-6 list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="space-y-6">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-[15px] placeholder:text-slate-400 focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 outline-none"
                        placeholder="John Doe">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-[15px] placeholder:text-slate-400 focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 outline-none"
                        placeholder="name@company.com">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Password</label>
                        <div class="relative group">
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-[15px] focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 outline-none">
                            <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Confirm</label>
                        <div class="relative group">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-[15px] focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 outline-none">
                        </div>
                    </div>
                </div>
                <p class="text-[11px] text-slate-400 ml-1 uppercase tracking-wider font-bold">Minimum 8 characters with a mix of symbols</p>

                <div class="flex items-start gap-3 px-1">
                    <input type="checkbox" id="terms" name="terms" required 
                        class="mt-1 w-4 h-4 rounded border-slate-300 text-black focus:ring-black transition-all cursor-pointer">
                    <label for="terms" class="text-sm font-medium text-slate-500 leading-snug cursor-pointer select-none">
                        I agree to the <a href="#" class="text-black font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-black font-bold hover:underline">Privacy Policy</a>.
                    </label>
                </div>

                <button type="submit" 
                    class="w-full bg-black text-white py-3.5 rounded-xl font-semibold text-[15px] hover:bg-zinc-800 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-black/5">
                    Create your account
                </button>
            </form>

            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                <div class="relative flex justify-center text-xs uppercase tracking-widest text-slate-400 font-bold bg-white px-4">Already a member?</div>
            </div>

            <a href="{{ route('login') }}" 
               class="flex items-center justify-center w-full py-3.5 border border-slate-200 rounded-xl font-semibold text-slate-700 text-[15px] hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">
                Sign in to your account
            </a>
        </div>

        <footer class="mt-12 text-center">
            <p class="text-slate-400 text-xs font-medium tracking-wide italic">Simplify your workflow.</p>
        </footer>
    </div>
</div>

<script>
// Improved Toggle Logic
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const passwordFields = [document.getElementById('password'), document.getElementById('password_confirmation')];
        const icon = this.querySelector('i');
        const isPassword = passwordFields[0].type === 'password';
        
        passwordFields.forEach(field => field.type = isPassword ? 'text' : 'password');
        icon.className = isPassword ? 'fas fa-eye-slash text-sm' : 'fas fa-eye text-sm';
    });
});
</script>
@endsection