<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Alumni</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased text-slate-600 bg-slate-50">

    <nav class="absolute top-0 left-0 w-full z-50 px-6 py-4 flex justify-between items-center max-w-7xl mx-auto right-0">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </div>
            <span class="text-xl font-bold text-slate-800 tracking-tight">SI-ALUMNI</span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <section class="relative h-screen flex items-center justify-center overflow-hidden bg-white">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute top-[20%] -right-[10%] w-[30%] h-[60%] bg-indigo-100 rounded-full blur-3xl opacity-60"></div>

        <div class="relative z-10 max-w-4xl px-6 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-600 text-xs font-bold tracking-wide mb-6 border border-blue-100">
                PORTAL RESMI ALUMNI
            </span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                Jalin Kembali <span class="text-blue-600">Koneksi</span> <br class="hidden md:block" /> Masa Depan Anda.
            </h1>
            <p class="text-lg text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                Platform terintegrasi untuk mengelola data alumni, memperluas jejaring profesional, dan menemukan peluang karir terbaru dari komunitas kita.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                     <a href="{{ url('/dashboard') }}" class="px-8 py-3.5 text-base font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-xl shadow-blue-600/20 w-full sm:w-auto">
                        Masuk ke Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-3.5 text-base font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-xl shadow-blue-600/20 w-full sm:w-auto">
                        Gabung Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3.5 text-base font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition w-full sm:w-auto">
                        Sudah punya akun?
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Update Data Alumni</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Pastikan data diri Anda selalu mutakhir untuk memudahkan kampus dan rekan alumni lain menghubungi Anda.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Info Lowongan Kerja</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Temukan peluang karir eksklusif yang dibagikan oleh jaringan alumni dan mitra perusahaan.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Jejaring Luas</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Cari teman seangkatan, kakak tingkat, atau mentor profesional melalui fitur pencarian direktori alumni.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-8 border-t border-slate-100 text-center">
        <p class="text-slate-400 text-sm">
            &copy; {{ date('Y') }} Sistem Informasi Alumni. Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}
        </p>
    </footer>

</body>
</html>