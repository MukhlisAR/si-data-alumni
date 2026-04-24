<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $news->title }} - Portal Alumni</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900 font-[figtree]">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/logo.png') }}" class="w-12 h-12 object-contain" alt="Logo MA Syekh Abdurrahman">
                    <span class="font-bold text-xl tracking-tight text-slate-800">Portal<span class="text-blue-600">Alumni</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('public.news.index') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Portal Berita</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-white bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-full shadow-lg shadow-blue-600/30 transition-all hover:scale-105">
                                Masuk ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-blue-600 px-4 py-2 transition-colors">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-bold text-white bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-full shadow-lg shadow-blue-600/30 transition-all hover:scale-105">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden min-h-screen">
        
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[500px] h-[500px] bg-blue-400/10 rounded-full blur-3xl z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] bg-indigo-400/10 rounded-full blur-3xl z-0 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <a href="{{ route('public.news.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 mb-8 border-2 border-slate-200 text-sm font-bold rounded-full text-slate-700 bg-white/80 backdrop-blur hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 transition-all hover:-translate-x-1 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Berita
            </a>

            <div class="mb-10 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-6 tracking-tight">{{ $news->title }}</h1>
                
                <div class="flex items-center justify-center md:justify-start text-slate-500 text-sm font-medium">
                    <span class="inline-flex py-1.5 px-4 rounded-full bg-blue-50 border border-blue-100 text-blue-700 shadow-sm items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Diterbitkan pada {{ $news->created_at->format('d F Y') }}
                    </span>
                </div>
            </div>

            @if($news->image)
                <div class="mb-10 rounded-3xl overflow-hidden shadow-xl shadow-slate-200/50 border border-white/50 bg-white p-2">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-auto max-h-[500px] object-cover rounded-2xl hover:scale-[1.02] transition-transform duration-700">
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-sm p-8 md:p-12 rounded-3xl shadow-xl shadow-slate-200/50 border border-white/60 text-slate-700 leading-relaxed text-lg prose prose-lg max-w-none prose-blue">
                {!! $news->content !!}
            </div>

        </div>
    </div>
</body>
</html>