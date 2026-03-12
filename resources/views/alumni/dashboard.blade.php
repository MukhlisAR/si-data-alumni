<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-lg overflow-hidden relative">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10"></div>
                <div class="absolute bottom-0 right-32 -mb-16 w-40 h-40 rounded-full bg-white opacity-10"></div>
                
                <div class="p-8 sm:p-10 relative z-10 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="text-center sm:text-left text-white">
                        <h3 class="text-3xl font-bold mb-2">Selamat Datang kembali, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-blue-100 text-lg max-w-2xl">Senang melihat Anda di Portal Sistem Informasi Alumni. Di sini Anda bisa memperbarui data, mencari teman angkatan, dan mendapat info terbaru.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1 bg-white rounded-3xl shadow-sm border border-slate-100 p-8 flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <h4 class="text-lg font-bold text-slate-800">Status Biodata</h4>
                        @if($isComplete)
                            <span class="flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Lengkap
                            </span>
                        @else
                            <span class="flex items-center gap-1.5 px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-bold border border-rose-200">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Belum Lengkap
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <p class="text-slate-600 text-sm mb-6 leading-relaxed">
                            @if($isComplete)
                                Luar biasa! Biodata Anda sudah terisi dengan lengkap. Pastikan untuk selalu memperbarui data jika Anda memiliki pekerjaan baru, agar jaringan alumni kita semakin kuat.
                            @else
                                <span class="block mb-2 font-semibold text-rose-600">Perhatian: Data belum diverifikasi!</span>
                                Silakan lengkapi NISN, Tempat/Tanggal Lahir, Jenis Kelamin, dan data lainnya agar akun Anda dapat diverifikasi oleh Admin sekolah.
                            @endif
                        </p>
                    </div>

                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <a href="{{ route('alumni.biodata') }}" class="block w-full py-3 px-4 {{ $isComplete ? 'bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200' : 'bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-600/30' }} text-center font-bold rounded-xl transition-all hover:-translate-y-0.5">
                            {{ $isComplete ? 'Perbarui Biodata' : 'Lengkapi Biodata Sekarang' }}
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <h4 class="text-lg font-bold text-slate-800">Berita & Lowongan Kerja Terbaru</h4>
                        <a href="{{ route('alumni.news.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua &rarr;</a>
                    </div>
                    
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-3 flex flex-col h-full">
                        <div class="flex flex-col gap-2 flex-1">
                            @forelse($latestNews as $news)
                                <a href="{{ route('alumni.news.show', $news->slug) }}" class="flex flex-col sm:flex-row gap-4 p-4 hover:bg-slate-50 rounded-2xl transition-colors border border-transparent hover:border-slate-100 group">
                                    <div class="w-full sm:w-36 h-24 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                        @if($news->image)
                                            <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Thumbnail">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 flex flex-col justify-center">
                                        <div class="text-xs font-semibold text-blue-600 mb-1.5 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}
                                        </div>
                                        <h5 class="text-base font-bold text-slate-800 mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $news->title }}</h5>
                                        <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed">{{ strip_tags($news->content) }}</p>
                                    </div>
                                </a>
                            @empty
                                <div class="p-8 text-center my-auto">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                    </div>
                                    <h4 class="text-slate-700 font-bold mb-1">Belum Ada Informasi</h4>
                                    <p class="text-slate-500 text-sm">Berita atau lowongan kerja terbaru akan muncul di sini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>