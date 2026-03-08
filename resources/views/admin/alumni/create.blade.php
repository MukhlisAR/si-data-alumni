<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.alumni.index') }}" class="text-slate-400 hover:text-blue-600 transition-colors bg-white p-2 rounded-xl border border-slate-100 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Tambah Alumni Manual') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 sm:p-10">
                    
                    <div class="mb-8 bg-blue-50 border border-blue-100 text-blue-800 px-5 py-4 rounded-xl flex items-start gap-4">
                        <div class="mt-1 bg-blue-200 text-blue-700 p-1.5 rounded-lg shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900 mb-1">Informasi Penting</h4>
                            <p class="text-sm leading-relaxed">Akun yang dibuat melalui halaman ini akan otomatis berstatus <strong>Terverifikasi</strong>. Alumni dapat login menggunakan email yang didaftarkan dengan password default: <code class="bg-white/80 px-2 py-0.5 rounded shadow-sm font-mono font-bold text-blue-700 border border-blue-200">password</code>. Mereka bisa mengubahnya nanti.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.alumni.store') }}" method="POST">
                        @csrf
                        
                        <h3 class="text-lg font-bold text-slate-800 mb-5 pb-2 border-b border-slate-100">Informasi Akun Utama</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white" placeholder="Contoh: Budi Santoso">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email Aktif</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white" placeholder="Contoh: budi@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-5 pb-2 border-b border-slate-100">Data Akademik</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="nim" class="block text-sm font-bold text-slate-700 mb-2">Nomor Induk Siswa/Mahasiswa</label>
                                <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white" placeholder="Contoh: 123456789">
                                <x-input-error :messages="$errors->get('nim')" class="mt-2 text-red-500" />
                            </div>

                            <div>
                                <label for="graduation_year" class="block text-sm font-bold text-slate-700 mb-2">Tahun Lulus</label>
                                <input type="number" id="graduation_year" name="graduation_year" value="{{ old('graduation_year') }}" required min="1990" max="{{ date('Y') + 1 }}"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white" placeholder="Contoh: 2023">
                                <x-input-error :messages="$errors->get('graduation_year')" class="mt-2 text-red-500" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="major" class="block text-sm font-bold text-slate-700 mb-2">Jurusan / Program Studi</label>
                                <select id="major" name="major" required
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white cursor-pointer">
                                    <option value="" disabled {{ old('major') ? '' : 'selected' }}>-- Pilih Jurusan Anda --</option>
                                    @foreach($majors as $jurusan)
                                        <option value="{{ $jurusan->name }}" {{ old('major') == $jurusan->name ? 'selected' : '' }}>
                                            {{ $jurusan->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('major')" class="mt-2 text-red-500" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('admin.alumni.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-bold hover:bg-slate-200 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Data Alumni
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>