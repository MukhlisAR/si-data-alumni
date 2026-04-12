<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Data Master: Daftar NISN Valid') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded shadow-sm">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-1 space-y-6">
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-slate-900 border-b border-slate-200">
                            <h3 class="font-bold text-lg mb-4">Tambah NISN (Manual)</h3>
                            <form action="{{ route('admin.valid_nisns.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <x-input-label for="nisn" :value="__('Nomor NISN')" />
                                    <x-text-input id="nisn" class="block mt-1 w-full" type="text" name="nisn" required placeholder="Contoh: 0012345678" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Nama Siswa (Opsional)')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Contoh: Budi Santoso" />
                                </div>
                                <x-primary-button class="w-full justify-center">Simpan Data</x-primary-button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-slate-900">
                            <h3 class="font-bold text-lg mb-2">Import Massal (Excel)</h3>
                            <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                                Pastikan baris pertama Excel memiliki judul kolom: <br>
                                <span class="font-bold text-emerald-600 bg-emerald-50 px-1 py-0.5 rounded">nisn</span> dan 
                                <span class="font-bold text-emerald-600 bg-emerald-50 px-1 py-0.5 rounded">nama</span>
                            </p>
                            
                            <form action="{{ route('admin.valid_nisn.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <input type="file" name="file_excel" required accept=".xlsx, .xls, .csv" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                                </div>
                                <button type="submit" class="w-full px-6 py-2 bg-emerald-600 text-white font-bold rounded-md hover:bg-emerald-700 transition-colors uppercase tracking-widest text-xs">
                                    Upload File Excel
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-slate-900">
                            <h3 class="font-bold text-lg mb-4">Daftar NISN Terdaftar</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="py-3 px-4 text-left border-b text-sm font-semibold text-slate-600">No</th>
                                            <th class="py-3 px-4 text-left border-b text-sm font-semibold text-slate-600">NISN</th>
                                            <th class="py-3 px-4 text-left border-b text-sm font-semibold text-slate-600">Nama Siswa</th>
                                            <th class="py-3 px-4 text-center border-b text-sm font-semibold text-slate-600">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($validNisns as $index => $item)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-3 px-4 border-b text-sm">{{ $index + 1 }}</td>
                                            <td class="py-3 px-4 border-b text-sm font-bold text-blue-600">{{ $item->nisn }}</td>
                                            <td class="py-3 px-4 border-b text-sm">{{ $item->name ?? '-' }}</td>
                                            <td class="py-3 px-4 border-b text-center">
                                                <form action="{{ route('admin.valid_nisns.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus NISN ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm transition-colors">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="py-8 text-center text-slate-500 text-sm">Belum ada data NISN yang diinput atau di-import.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>