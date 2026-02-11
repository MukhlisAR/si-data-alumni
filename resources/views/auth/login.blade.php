<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h3 class="text-xl font-bold text-slate-800">Selamat Datang Kembali</h3>
        <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-medium" />
            <x-text-input id="password" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4 flex justify-between items-center">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 !rounded-xl text-base font-semibold shadow-lg shadow-blue-600/20">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
        
        <p class="mt-6 text-center text-sm text-slate-500">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </form>
</x-guest-layout>