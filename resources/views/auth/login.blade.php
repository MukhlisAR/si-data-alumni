<x-guest-layout>
    
    <div class="mb-8 text-center lg:text-left">
        <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Masuk ke Akun</h2>
        <p class="text-slate-500 text-sm font-medium">Silakan masukkan email dan kata sandi Anda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com"
                class="block w-full px-4 py-3.5 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white placeholder-slate-400 font-medium" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-sm font-bold text-slate-700">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-bold hover:underline transition-colors">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                class="block w-full px-4 py-3.5 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white placeholder-slate-400 font-medium font-mono tracking-widest" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-600 bg-slate-50 transition-colors cursor-pointer">
            <label for="remember_me" class="ml-3 block text-sm text-slate-600 font-semibold cursor-pointer select-none">
                Ingat saya di perangkat ini
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/30 text-sm font-extrabold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all hover:-translate-y-1">
                Masuk Sekarang
            </button>
        </div>
        
        <p class="text-center text-sm text-slate-500 mt-8 font-medium border-t border-slate-100 pt-6">
            Belum menjadi anggota? 
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition-colors">Daftar sekarang</a>
        </p>
    </form>
    
</x-guest-layout>