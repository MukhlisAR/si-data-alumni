<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Berita - Sistem Informasi Alumni</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900 font-[figtree]">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <a href="/" class="flex items-center gap-3 hover:opacity-80 transition">
                    <img src="{{ asset('assets/logo.png') }}" class="w-12 h-12 object-contain" alt="Logo MA Syekh Abdurrahman">
                    <span class="font-bold text-xl tracking-tight text-slate-800">Portal<span class="text-blue-600">Alumni</span></span>
                </a>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('public.news.index') }}" class="font-bold text-blue-600 border-b-2 border-blue-600 pb-1">Portal Berita</a>

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

    <div class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 min-h-screen overflow-hidden">
        
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[500px] h-[500px] bg-blue-400/10 rounded-full blur-3xl z-0 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] bg-indigo-400/10 rounded-full blur-3xl z-0 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="text-center mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-sm font-semibold mb-4 shadow-sm">
                    Pusat Informasi
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">
                    Berita & Pengumuman <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Terbaru</span>
                </h1>
                <p class="max-w-2xl mx-auto text-slate-500 text-lg">
                    Ikuti terus perkembangan terbaru, kegiatan, dan informasi penting seputar alumni dan almamater.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($news as $item)
                    <div class="group bg-white/80 backdrop-blur-sm rounded-3xl p-3 border border-white/60 shadow-xl shadow-slate-200/40 hover:shadow-2xl hover:shadow-blue-200/50 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
                        
                        <div class="rounded-2xl overflow-hidden aspect-video bg-slate-100 mb-4 relative">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="px-3 pb-4 flex-1 flex flex-col">
                            <h2 class="font-extrabold text-xl mb-3 text-slate-800 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('public.news.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>
                            <p class="text-slate-500 text-sm line-clamp-3 mb-6 flex-1">
                                {{ Str::limit(strip_tags($item->content), 120) }}
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-slate-100">
                                <a href="{{ route('public.news.show', $item->slug) }}" class="inline-flex items-center text-sm font-bold text-blue-600 group-hover:text-blue-700">
                                    Baca selengkapnya 
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white/50 backdrop-blur border border-dashed border-slate-300 rounded-3xl">
                        <svg class="w-16 h-16 mx-auto text-slate-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Berita</h3>
                        <p class="text-slate-500">Saat ini belum ada pengumuman atau berita yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12">
                {{ $news->links() }}
            </div>

        </div>
    </div>

</body>
</html>