<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Kelola Biodata') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    
                    <form action="{{ route('alumni.biodata.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <h3 class="text-lg font-bold text-slate-700 mb-4 border-b pb-2">Data Akademik</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="nim" :value="__('NIM')" />
                                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim', $alumni->nim)" required />
                                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="graduation_year" :value="__('Tahun Lulus')" />
                                <x-text-input id="graduation_year" class="block mt-1 w-full" type="number" name="graduation_year" :value="old('graduation_year', $alumni->graduation_year)" required />
                                <x-input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="major" :value="__('Jurusan / Program Studi')" />
                                <select id="major" name="major" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($majors as $jurusan)
                                        <option value="{{ $jurusan->name }}" {{ old('major', $alumni->major) == $jurusan->name ? 'selected' : '' }}>
                                            {{ $jurusan->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('major')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-700 mb-4 border-b pb-2 pt-4">Data Pribadi & Kontak</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="phone" :value="__('No. WhatsApp / HP')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $alumni->phone)" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="address" :value="__('Alamat Domisili')" />
                                <textarea id="address" name="address" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" rows="3">{{ old('address', $alumni->address) }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-700 mb-4 border-b pb-2 pt-4">Pekerjaan Saat Ini</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="job_title" :value="__('Posisi / Jabatan')" />
                                <x-text-input id="job_title" class="block mt-1 w-full" type="text" name="job_title" :value="old('job_title', $alumni->job_title)" placeholder="Contoh: Staff IT, Guru, dll" />
                            </div>

                            <div>
                                <x-input-label for="company" :value="__('Nama Instansi / Perusahaan')" />
                                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company', $alumni->company)" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4 bg-blue-600 hover:bg-blue-700">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>