<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portal Alumni') }} - Masuk</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[figtree] text-slate-900 antialiased bg-slate-50">
    
    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-800 p-12 text-white flex-col justify-between relative overflow-hidden">
            
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 -right-10 w-72 h-72 bg-blue-400 opacity-20 rounded-full blur-2xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-12">
                    <img src="{{ asset('assets/logo.png') }}" class="w-16 h-16 bg-white p-2 rounded-xl shadow-lg object-contain" alt="Logo Sekolah">
                    <span class="font-bold text-2xl tracking-tight">Portal<span class="text-blue-200">Alumni</span></span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                    Selamat Datang <br>Kembali di Rumah.
                </h1>
                <p class="text-blue-100 text-lg max-w-md leading-relaxed">
                    Masuk ke akun Anda untuk mulai terhubung dengan ribuan alumni, mendapatkan info karir eksklusif, dan memperluas jaringan profesional.
                </p>
            </div>
            
            <div class="relative z-10 text-sm text-blue-200 font-medium">
                &copy; {{ date('Y') }} Sistem Informasi Alumni.
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative bg-slate-50">
            
            <div class="absolute top-8 left-8 lg:hidden flex items-center gap-2">
                <img src="{{ asset('assets/logo.png') }}" class="w-10 h-10 bg-white p-1 rounded-lg shadow-md object-contain" alt="Logo Sekolah">
            </div>

            <div class="w-full max-w-md bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 sm:p-10 border border-slate-100">
                
                {{ $slot }}
                
            </div>
            
        </div>
    </div>

</body>
</html>