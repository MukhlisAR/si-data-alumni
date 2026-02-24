<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Detail Alumni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    
                    <div class="flex justify-between items-start mb-6 border-b pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-800">{{ $alumni->user->name }}</h3>
                            <p class="text-slate-500">{{ $alumni->user->email }}</p>
                        </div>
                        <div class="flex flex-col items-end">
                             <span class="text-sm text-slate-400 mb-1">Status Saat Ini:</span>
                             @if($alumni->status == 'verified')
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs font-bold">Verified</span>
                            @elseif($alumni->status == 'rejected')
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs font-bold">Rejected</span>
                            @else
                                <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs font-bold">Pending</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h4 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Informasi Akademik</h4>
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <p><span class="font-semibold">NIM:</span> {{ $alumni->nim }}</p>
                                <p><span class="font-semibold">Jurusan:</span> {{ $alumni->major }}</p>
                                <p><span class="font-semibold">Tahun Lulus:</span> {{ $alumni->graduation_year }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Pekerjaan & Kontak</h4>
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <p><span class="font-semibold">No HP:</span> {{ $alumni->phone ?? '-' }}</p>
                                <p><span class="font-semibold">Pekerjaan:</span> {{ $alumni->job_title ?? '-' }}</p>
                                <p><span class="font-semibold">Perusahaan:</span> {{ $alumni->company ?? '-' }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $alumni->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t pt-6">
                        <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition">
                            Kembali
                        </a>

                        <form action="{{ route('admin.alumni.verify', $alumni->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition font-semibold">
                                Tolak Data
                            </button>
                        </form>

                        <form action="{{ route('admin.alumni.verify', $alumni->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="verified">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-lg shadow-green-600/30">
                                Verifikasi & Terima
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>