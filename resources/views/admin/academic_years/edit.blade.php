<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Data Master: Tahun Angkatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900 border-b border-slate-200">
                    
                    <h3 class="font-bold text-lg mb-6">Ubah Tahun Angkatan</h3>
                    
                    <!-- Form Action mengarah ke route update dan membawa $year->id -->
                    <form action="{{ route('admin.academic_years.update', $year->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <x-input-label for="year_name" :value="__('Tahun Angkatan')" />
                            
                            <!-- Value diisi dengan data lama yaitu $year->year_name -->
                            <x-text-input id="year_name" class="block mt-1 w-full" type="text" name="year_name" 
                                value="{{ old('year_name', $year->year_name) }}" required />
                                
                            @error('year_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Batal & Simpan -->
                        <div class="flex items-center justify-end gap-3 mt-8">
                            <a href="{{ route('admin.academic_years.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-md font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>