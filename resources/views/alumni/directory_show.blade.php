<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('alumni.directory') }}" class="text-slate-400 hover:text-blue-600 transition-colors bg-white p-2 rounded-xl border border-slate-100 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Profil Alumni') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                
                <div class="h-40 bg-gradient-to-r from-blue-600 to-indigo-700 relative"></div>

                <div class="p-8 sm:p-12 pt-0">
                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6 -mt-16 mb-8 relative z-10">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg bg-slate-100 flex-shrink-0">
                            @if($alumniDetail->photo)
                                <img src="{{ asset('storage/' . $alumniDetail->photo) }}" class="w-full h-full object-cover" alt="Foto">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-blue-600 font-bold text-5xl bg-blue-50">
                                    {{ strtoupper(substr($alumniDetail->user->name ?? 'A', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="text-center sm:text-left pb-2">
                            <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ $alumniDetail->user->name ?? 'N/A' }}</h3>
                            <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 text-blue-700 text-sm font-bold border border-blue-100">
                                Angkatan {{ $alumniDetail->graduation_year ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-5 border-b border-slate-200 pb-2">Data Akademik</h4>
                            <ul class="space-y-4">
                                <li class="flex flex-col"><span class="font-semibold text-slate-700 text-sm">Jurusan</span> <span class="text-slate-600">{{ $alumniDetail->major ?? '-' }}</span></li>
                                <li class="flex flex-col"><span class="font-semibold text-slate-700 text-sm">Tempat, Tanggal Lahir</span> <span class="text-slate-600">{{ $alumniDetail->tempat_lahir ?? '-' }}, {{ $alumniDetail->tanggal_lahir ? \Carbon\Carbon::parse($alumniDetail->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span></li>
                            </ul>
                        </div>

                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-5 border-b border-slate-200 pb-2">Pekerjaan & Kontak</h4>
                            <ul class="space-y-4">
                                <li class="flex flex-col"><span class="font-semibold text-slate-700 text-sm">Pekerjaan Saat Ini</span> <span class="text-slate-600">{{ $alumniDetail->job_title ?? 'Belum ada data' }} {{ $alumniDetail->company ? 'di ' . $alumniDetail->company : '' }}</span></li>
                                <li class="flex flex-col"><span class="font-semibold text-slate-700 text-sm">Domisili</span> <span class="text-slate-600">{{ $alumniDetail->address ?? '-' }}</span></li>
                                
                                @if($alumniDetail->phone)
                                <li class="pt-4 mt-2 border-t border-slate-200">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $alumniDetail->phone) }}" target="_blank" class="inline-flex items-center justify-center w-full px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition-all shadow-md shadow-emerald-500/30 gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.418-.1.824z"/></svg>
                                        Hubungi via WhatsApp
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>