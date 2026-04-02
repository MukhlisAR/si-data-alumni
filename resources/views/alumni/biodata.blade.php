<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Kelola Biodata') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-600 px-5 py-4 rounded-xl font-medium flex items-center gap-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 sm:p-10 text-slate-900">
                    
                    <form action="{{ route('alumni.biodata.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-8 flex flex-col sm:flex-row items-center gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-slate-200 border-4 border-white shadow-md flex-shrink-0">
                                @if($alumni && $alumni->photo)
                                    <img src="{{ asset('storage/' . $alumni->photo) }}" class="w-full h-full object-cover" alt="Foto Profil">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-blue-600 font-bold text-3xl bg-blue-100">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 w-full">
                                <label for="photo" class="block text-sm font-bold text-slate-700 mb-2">Upload Foto Profil Baru (Opsional)</label>
                                <input type="file" id="photo" name="photo" class="block w-full text-sm text-slate-500 
                                    file:mr-4 file:py-2.5 file:px-5
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-100 file:text-blue-700
                                    hover:file:bg-blue-200 transition-colors cursor-pointer" />
                                <p class="text-xs text-slate-500 mt-2">Format: JPG, PNG. Maksimal ukuran 2MB.</p>
                                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-5 pb-2 border-b border-slate-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Data Pribadi
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir</label>
                                <input id="tempat_lahir" type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $alumni->tempat_lahir ?? '') }}" required placeholder="Contoh: Pamekasan" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                                <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                            </div>

                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir</label>
                                <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $alumni->tanggal_lahir ?? '') }}" required class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 mb-3">Jenis Kelamin</label>
                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ (old('jenis_kelamin', $alumni->jenis_kelamin ?? '') == 'Laki-laki') ? 'checked' : '' }} required class="w-5 h-5 text-blue-600 focus:ring-blue-600 border-slate-300">
                                        <span class="text-slate-700 font-medium">Laki-laki</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ (old('jenis_kelamin', $alumni->jenis_kelamin ?? '') == 'Perempuan') ? 'checked' : '' }} required class="w-5 h-5 text-blue-600 focus:ring-blue-600 border-slate-300">
                                        <span class="text-slate-700 font-medium">Perempuan</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-5 pb-2 border-b border-slate-100 flex items-center gap-2 pt-4">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                            Data Akademik
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="nisn" class="block text-sm font-bold text-slate-700 mb-2">NISN</label>
                                <input id="nisn" type="text" name="nisn" value="{{ old('nisn', $alumni->nisn ?? '') }}" required placeholder="Nomor Induk Siswa Nasional" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                                <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                            </div>

                            <div>
                                <label for="graduation_year" class="block text-sm font-bold text-slate-700 mb-2">Tahun Lulus / Angkatan</label>
                                <select id="graduation_year" name="graduation_year" required class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors cursor-pointer">
                                    <option value="" disabled {{ old('graduation_year', $alumni->graduation_year ?? '') ? '' : 'selected' }}>-- Pilih Tahun Lulus / Angkatan --</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year->year_name }}" {{ old('graduation_year', $alumni->graduation_year ?? '') == $year->year_name ? 'selected' : '' }}>
                                            {{ $year->year_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="major" class="block text-sm font-bold text-slate-700 mb-2">Jurusan</label>
                                <input id="major" type="text" name="major" value="{{ old('major', $alumni->major ?? '') }}" required placeholder="Contoh: Teknik Komputer dan Jaringan" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                                <x-input-error :messages="$errors->get('major')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-5 pb-2 border-b border-slate-100 flex items-center gap-2 pt-4">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            Kontak & Status Saat Ini
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">No. WhatsApp / HP</label>
                                <input id="phone" type="text" name="phone" value="{{ old('phone', $alumni->phone ?? '') }}" placeholder="Contoh: 08123456789" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                            </div>

                            <div>
                                <label for="job_title" class="block text-sm font-bold text-slate-700 mb-2">Status / Posisi Pekerjaan (Opsional)</label>
                                <input id="job_title" type="text" name="job_title" value="{{ old('job_title', $alumni->job_title ?? '') }}" placeholder="Contoh: Mahasiswa, Guru, Staff IT" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="company" class="block text-sm font-bold text-slate-700 mb-2">Nama Instansi / Perusahaan (Opsional)</label>
                                <input id="company" type="text" name="company" value="{{ old('company', $alumni->company ?? '') }}" placeholder="Contoh: Universitas Brawijaya / PT. Maju Jaya" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-bold text-slate-700 mb-2">Alamat Domisili</label>
                                <textarea id="address" name="address" rows="3" class="block w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus:bg-white transition-colors">{{ old('address', $alumni->address ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-slate-100">
                            <button type="submit" class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                Simpan Biodata
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>