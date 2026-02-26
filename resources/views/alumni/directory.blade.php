<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Direktori Alumni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-slate-100">
                <div class="p-6 text-slate-900">
                    <form action="{{ route('alumni.directory') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        
                        <div class="flex-1">
                            <x-text-input id="search" class="block w-full" type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alumni..." />
                        </div>

                        <div class="md:w-1/4">
                            <select name="year" class="block w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm">
                                <option value="">Semua Angkatan</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                        Lulusan {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-primary-button class="justify-center bg-blue-600 hover:bg-blue-700 h-11">
                            Cari Teman
                        </x-primary-button>
                        
                        @if(request('search') || request('year'))
                            <a href="{{ route('alumni.directory') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-200 border border-transparent rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-300 transition h-11">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($alumnis as $alumni)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100 overflow-hidden flex flex-col">
                        <div class="h-20 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                        
                        <div class="relative flex justify-center -mt-10 mb-3">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center border-4 border-white shadow-sm overflow-hidden text-2xl font-bold text-slate-300 bg-slate-100">
                                @if($alumni->photo)
                                    <img src="{{ asset('storage/' . $alumni->photo) }}" class="w-full h-full object-cover" alt="{{ $alumni->user->name }}">
                                @else
                                    {{ strtoupper(substr($alumni->user->name, 0, 1)) }}
                                @endif
                            </div>
                        </div>

                        <div class="p-5 text-center flex-1 flex flex-col">
                            <h3 class="font-bold text-lg text-slate-800 leading-tight mb-1">{{ $alumni->user->name }}</h3>
                            <p class="text-xs font-semibold text-blue-600 mb-4 bg-blue-50 inline-block px-3 py-1 rounded-full mx-auto">
                                Lulusan {{ $alumni->graduation_year }}
                            </p>
                            
                            <div class="space-y-2 text-sm text-slate-600 mt-auto">
                                <p class="flex items-start justify-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                    {{ $alumni->major }}
                                </p>
                                
                                @if($alumni->job_title)
                                <p class="flex items-start justify-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $alumni->job_title }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-lg p-10 text-center border border-slate-100 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-lg font-bold text-slate-700">Tidak ada data ditemukan</h3>
                        <p class="text-slate-500 mt-1">Belum ada alumni terverifikasi atau tidak ada yang cocok dengan pencarian Anda.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $alumnis->links() }}
            </div>

        </div>
    </div>
</x-app-layout>