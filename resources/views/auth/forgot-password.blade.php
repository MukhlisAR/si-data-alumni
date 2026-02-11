<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 19l-1 1-1-1-2-2-1-1m8-14a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800">Reset Password</h3>
    </div>

    <div class="mb-4 text-sm text-slate-500 text-center">
        {{ __('Lupa password Anda? Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mereset password.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center justify-end">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 !rounded-xl text-base font-semibold shadow-lg shadow-blue-600/20">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-slate-800">Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>