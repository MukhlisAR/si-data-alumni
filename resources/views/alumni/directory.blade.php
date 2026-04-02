<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Direktori Alumni') }}
        </h2>
        <p class="text-sm text-slate-500 mt-1">Temukan dan terhubung kembali dengan rekan-rekan alumni lainnya.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
                <form action="{{ route('alumni.directory') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    
                    <div class="flex-1">
                        <label for="search" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Nama Alumni</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors" placeholder="Ketik nama teman Anda...">
                        </div>
                    </div>

                    <div class="md:w-64">
                        <label for="year" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Filter Angkatan</label>
                        <select name="year" id="year" onchange="this.form.submit()" class="block w-full py-3 px-4 border border-slate-300 rounded-xl leading-5 bg-slate-50 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors cursor-pointer">
                            <option value="">-- Semua Angkatan --</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>Lulusan Tahun {{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2 md:w-auto mt-4 md:mt-0">
                        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md shadow-blue-600/20 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            Cari Teman
                        </button>
                        
                        @if(request('search') || request('year'))
                            <a href="{{ route('alumni.directory') }}" class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-colors flex items-center justify-center" title="Reset Pencarian">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($alumnis as $alumni)
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                        
                        <div class="h-24 bg-gradient-to-r from-blue-500 to-indigo-600 relative shrink-0"></div>
                        
                        <div class="px-6 flex justify-center -mt-12 relative z-10 shrink-0">
                            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-md bg-slate-100 flex-shrink-0">
                                @if($alumni->photo)
                                    <img src="{{ asset('storage/' . $alumni->photo) }}" class="w-full h-full object-cover" alt="{{ $alumni->user->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-blue-600 font-bold text-3xl bg-blue-50">
                                        {{ strtoupper(substr($alumni->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 text-center pt-4 flex flex-col flex-1">
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 mb-1 group-hover:text-blue-600 transition-colors line-clamp-1" title="{{ $alumni->user->name ?? 'User Terhapus' }}">
                                    {{ $alumni->user->name ?? 'User Terhapus' }}
                                </h3>
                                
                                <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold mb-4 border border-blue-100">
                                    Angkatan {{ $alumni->graduation_year ?? '-' }}
                                </div>

                                <div class="space-y-3 text-sm text-slate-600 mb-4">
                                    <div class="flex items-start justify-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                                        <span class="line-clamp-1" title="{{ $alumni->major ?? '-' }}">{{ $alumni->major ?? '-' }}</span>
                                    </div>
                                    
                                    <div class="flex items-start justify-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                        <span class="line-clamp-2 leading-snug">
                                            @if($alumni->job_title || $alumni->company)
                                                <span class="font-medium text-slate-700">{{ $alumni->job_title ?? 'Bekerja' }}</span> 
                                                {{ $alumni->company ? 'di ' . $alumni->company : '' }}
                                            @else
                                                <span class="text-slate-400 italic">Belum ada info pekerjaan</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-auto pt-4 border-t border-slate-100">
                                <a href="{{ route('alumni.directory.show', $alumni->id) }}" class="block w-full py-2.5 bg-slate-50 hover:bg-blue-600 text-slate-600 hover:text-white font-semibold rounded-xl transition-all duration-300">
                                    Lihat Profil Detail
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 mb-2">Tidak Ada Data Ditemukan</h3>
                        <p class="text-slate-500 max-w-md mx-auto">Kami tidak dapat menemukan alumni yang cocok dengan pencarian atau filter Anda. Coba kata kunci atau tahun angkatan yang lain.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $alumnis->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>