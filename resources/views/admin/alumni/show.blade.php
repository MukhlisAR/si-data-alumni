<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Detail Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 sm:p-10">

                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-slate-100 pb-6 mb-6 gap-4">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden bg-slate-200 border-4 border-white shadow-md flex-shrink-0">
                                @if($alumni->photo)
                                    <img src="{{ asset('storage/' . $alumni->photo) }}" class="w-full h-full object-cover" alt="Foto Profil">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-blue-600 font-bold text-3xl bg-blue-100">
                                        {{ strtoupper(substr($alumni->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-slate-800">{{ $alumni->user->name ?? 'Nama Tidak Tersedia' }}</h3>
                                <p class="text-slate-500">{{ $alumni->user->email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="text-left sm:text-right">
                            <p class="text-sm text-slate-500 mb-1">Status Saat Ini:</p>
                            @if($alumni->status == 'verified')
                                <span class="px-4 py-1.5 bg-green-100 text-green-800 rounded-full text-sm font-bold shadow-sm border border-green-200">Verified</span>
                            @elseif($alumni->status == 'pending')
                                <span class="px-4 py-1.5 bg-yellow-100 text-yellow-800 rounded-full text-sm font-bold shadow-sm border border-yellow-200">Pending</span>
                            @else
                                <span class="px-4 py-1.5 bg-red-100 text-red-800 rounded-full text-sm font-bold shadow-sm border border-red-200">Rejected</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 bg-slate-50 p-6 sm:p-8 rounded-2xl border border-slate-100">
                        
                        <div>
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-5 border-b border-slate-200 pb-2">Informasi Pribadi & Akademik</h4>
                            <ul class="space-y-4">
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">NISN</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->nisn ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Tempat Lahir</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->tempat_lahir ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Tanggal Lahir</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->tanggal_lahir ? \Carbon\Carbon::parse($alumni->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Jenis Kelamin</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->jenis_kelamin ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row mt-6 pt-2 border-t border-slate-200/60"><span class="sm:w-36 font-semibold text-slate-700">Jurusan</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->major ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Tahun Lulus</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->graduation_year ?? '-' }}</span></li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-5 border-b border-slate-200 pb-2">Pekerjaan & Kontak</h4>
                            <ul class="space-y-4">
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">No. HP / WA</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->phone ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Pekerjaan</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->job_title ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Perusahaan</span> <span class="text-slate-600 sm:flex-1"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->company ?? '-' }}</span></li>
                                <li class="flex flex-col sm:flex-row"><span class="sm:w-36 font-semibold text-slate-700">Alamat Domisili</span> <span class="text-slate-600 sm:flex-1 leading-relaxed"><span class="hidden sm:inline mr-2">:</span>{{ $alumni->address ?? '-' }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.alumni.index') }}" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold transition-colors">Kembali</a>
                        
                        @if($alumni->status !== 'rejected')
                        <form action="{{ route('admin.alumni.verify', $alumni->id) }}" method="POST" class="inline m-0">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="px-6 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 rounded-xl font-bold transition-colors">Tolak Data</button>
                        </form>
                        @endif

                        @if($alumni->status !== 'verified')
                        <form action="{{ route('admin.alumni.verify', $alumni->id) }}" method="POST" class="inline m-0">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="verified">
                            <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold shadow-lg shadow-green-600/30 transition-all hover:-translate-y-0.5">Verifikasi & Terima</button>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>