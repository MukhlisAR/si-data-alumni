<x-guest-layout>
    <div class="mb-6 text-center">
        <h3 class="text-xl font-bold text-slate-800">Buat Akun Baru</h3>
        <p class="text-sm text-slate-500 mt-1">Bergabung dengan komunitas alumni</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-medium" />
            <x-text-input id="name" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-medium" />
            <x-text-input id="password" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 font-medium" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 !rounded-xl text-base font-semibold shadow-lg shadow-blue-600/20">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>

        <p class="mt-6 text-center text-sm text-slate-500">
            Sudah terdaftar? 
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">Masuk disini</a>
        </p>
    </form>
</x-guest-layout>