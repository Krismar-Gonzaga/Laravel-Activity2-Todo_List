@extends('layouts.app')

@section('title', 'Login - TaskFlow')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center p-6 bg-white selection:bg-black selection:text-white">
    <div class="w-full max-w-[400px]">
        
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-black mb-6 shadow-xl shadow-black/10">
                <i class="fas fa-tasks text-white text-lg"></i>
            </div>
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Welcome back</h1>
            <p class="mt-2 text-slate-500 font-medium">Log in to your workspace to continue.</p>
        </div>

        @if(session('success') || $errors->any())
            <div class="mb-6 animate-in fade-in slide-in-from-top-2 duration-500">
                @if(session('success'))
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-sm">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 rounded-xl bg-red-50 border border-red-100 text-red-800 text-sm">
                        <div class="flex items-center gap-2 mb-1 font-semibold">
                            <i class="fas fa-circle-exclamation"></i> Invalid credentials
                        </div>
                        <ul class="opacity-80 ml-6 list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <div class="space-y-6">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-[15px] placeholder:text-slate-400 focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 outline-none"
                        placeholder="name@company.com">
                </div>

                <div>
                    <div class="flex justify-between mb-2 ml-1">
                        <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                        <a href="#" class="text-sm font-medium text-slate-400 hover:text-black transition-colors">Forgot?</a>
                    </div>
                    <div class="relative group">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-[15px] placeholder:text-slate-400 focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 outline-none">
                        <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-1">
                    <input type="checkbox" id="remember" name="remember" 
                        class="w-4 h-4 rounded border-slate-300 text-black focus:ring-black transition-all cursor-pointer">
                    <label for="remember" class="text-sm font-medium text-slate-500 cursor-pointer select-none">Remember for 30 days</label>
                </div>

                <button type="submit" 
                    class="w-full bg-black text-white py-3.5 rounded-xl font-semibold text-[15px] hover:bg-zinc-800 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-black/5">
                    Sign in to account
                </button>
            </form>

            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                <div class="relative flex justify-center text-xs uppercase tracking-widest text-slate-400 font-bold bg-white px-4">Or continue with</div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all font-medium text-slate-700 text-sm">
                    <i class="fab fa-google text-slate-400"></i> Google
                </button>
                <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all font-medium text-slate-700 text-sm">
                    <i class="fab fa-github text-slate-400"></i> GitHub
                </button>
            </div>

            <p class="text-center text-slate-500 text-sm font-medium">
                New to TaskFlow? 
                <a href="{{ route('register') }}" class="text-black font-bold hover:underline underline-offset-4">Create account</a>
            </p>
        </div>

        <footer class="mt-16 text-center">
            <p class="text-slate-400 text-xs font-medium tracking-wide italic">Built for teams who move fast.</p>
        </footer>
    </div>
</div>

<script>
document.querySelector('.toggle-password').addEventListener('click', function() {
    const input = document.getElementById('password');
    const icon = this.querySelector('i');
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    icon.className = isPassword ? 'fas fa-eye-slash text-sm' : 'fas fa-eye text-sm';
});
</script>
@endsection