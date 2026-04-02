<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Data Master: Tahun Angkatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-slate-900 border-b border-slate-200">
                            <h3 class="font-bold text-lg mb-4">Tambah Angkatan Baru</h3>
                            <form action="{{ route('admin.academic_years.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <x-input-label for="year_name" :value="__('Tahun Angkatan')" />
                                    <x-text-input id="year_name" class="block mt-1 w-full" type="text" name="year_name" required placeholder="Contoh: 2024 atau 2023/2024" />
                                </div>
                                <x-primary-button class="w-full justify-center">Simpan Data</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-slate-900">
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="py-3 px-4 text-left border-b text-sm font-semibold text-slate-600">No</th>
                                            <th class="py-3 px-4 text-left border-b text-sm font-semibold text-slate-600">Tahun Angkatan</th>
                                            <th class="py-3 px-4 text-center border-b text-sm font-semibold text-slate-600">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($years as $index => $y)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-3 px-4 border-b text-sm">{{ $index + 1 }}</td>
                                            <td class="py-3 px-4 border-b text-sm font-medium">{{ $y->year_name }}</td>
                                            <td class="py-3 px-4 border-b text-center">
                                                <form action="{{ route('admin.academic_years.destroy', $y->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus angkatan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm transition-colors">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="py-8 text-center text-slate-500 text-sm">Belum ada data tahun angkatan yang ditambahkan.</td>
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