<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Broadcast WhatsApp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded shadow-sm">
                    <b>Berhasil!</b> {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-sm">
                    <b>Gagal!</b> {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-slate-900">
                            <h3 class="font-bold text-lg mb-4 border-b pb-2">1. Filter & Pesan</h3>
                            
                            <form action="{{ route('admin.broadcast.index') }}" method="GET">
                                <input type="hidden" name="filter" value="true">

                                <div class="mb-4">
                                    <x-input-label for="year" :value="__('Tahun Lulus')" />
                                    <select name="year" class="block mt-1 w-full border-slate-300 rounded-lg shadow-sm">
                                        <option value="">-- Semua Tahun --</option>
                                        @foreach($years as $y)
                                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="message" :value="__('Isi Pesan WA')" />
                                    <textarea name="message" rows="6" class="block mt-1 w-full border-slate-300 rounded-lg shadow-sm" placeholder="Halo kak {name}, kami mengundang..." required>{{ request('message') }}</textarea>
                                    <p class="text-xs text-slate-500 mt-1">*Gunakan {name} untuk menyapa nama alumni secara otomatis.</p>
                                </div>

                                <x-primary-button class="w-full justify-center">
                                    Generate Daftar Kirim
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                        <div class="p-6 text-slate-900">
                            <h3 class="font-bold text-lg mb-4 border-b pb-2 flex justify-between items-center">
                                <span>2. Daftar Target Kirim</span>
                                <span class="text-sm bg-blue-100 text-blue-800 py-1 px-3 rounded-full">
                                    {{ isset($targets) ? $targets->count() : 0 }} Penerima
                                </span>
                            </h3>

                            @if(!isset($targets) || $targets->isEmpty())
                                <div class="text-center py-10 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.682 8-8 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 3.682-8 8-8s8 3.582 8 8z" />
                                    </svg>
                                    <p>Silakan pilih Tahun Lulus dan klik Generate.</p>
                                </div>
                            @else
                                
                                <div class="mb-6 bg-emerald-50 border border-emerald-200 p-5 rounded-xl shadow-sm">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-emerald-100 p-2 rounded-lg text-emerald-600 mt-1">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-emerald-800 text-lg">Kirim Massal via Fonnte</h4>
                                            <p class="text-sm text-emerald-700 mb-4 mt-1">Kirim pesan otomatis ke <b>{{ $targets->count() }} alumni</b> di bawah ini sekaligus. Sistem akan memberikan jeda agar nomor Anda tidak diblokir WA.</p>
                                            
                                            <form action="{{ route('admin.broadcast.send') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="year" value="{{ request('year') }}">
                                                <input type="hidden" name="message" value="{{ request('message') }}">
                                                
                                                <button type="submit" onclick="return confirm('Yakin ingin mengirim pesan otomatis ke {{ $targets->count() }} orang?')" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg shadow transition-all">
                                                    Kirim Broadcast Sekarang
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="overflow-y-auto max-h-[400px] pr-2">
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Atau Kirim Manual Satu per Satu</h4>
                                    <div class="space-y-3">
                                        @foreach($targets as $target)
                                            @php
                                                $finalMsg = str_replace('{name}', $target->user->name, request('message'));
                                                $url = "https://wa.me/" . ($target->formatted_phone ?? $target->phone) . "?text=" . urlencode($finalMsg);
                                            @endphp

                                            <div class="flex items-center justify-between p-3 border border-slate-200 rounded-lg hover:bg-slate-50 transition">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-xs">
                                                        WA
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-slate-700">{{ $target->user->name }}</div>
                                                        <div class="text-xs text-slate-500">{{ $target->phone }}</div>
                                                    </div>
                                                </div>
                                                
                                                <a href="{{ $url }}" target="_blank" class="flex items-center gap-2 px-3 py-2 bg-green-500 text-white rounded-md text-sm font-semibold hover:bg-green-600 transition shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                                    </svg>
                                                    Kirim
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>