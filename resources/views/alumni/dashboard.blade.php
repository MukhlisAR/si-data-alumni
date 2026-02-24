<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Alumni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-slate-100">
                <div class="p-6 text-slate-900 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold">Status Data Biodata Anda</h3>
                        @if($isComplete)
                            <p class="text-green-600 mt-1 flex items-center gap-2 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Data Lengkap
                            </p>
                        @else
                            <p class="text-red-500 mt-1 flex items-center gap-2 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Data Belum Lengkap. Harap segera diisi!
                            </p>
                        @endif
                    </div>
                    
                    <a href="{{ route('alumni.biodata') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                        @if($isComplete) Update Biodata @else Lengkapi Biodata @endif
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    <h3 class="text-xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Ini adalah portal resmi Sistem Informasi Alumni. Di sini Anda dapat memperbarui data diri Anda, mendapatkan informasi/berita terbaru seputar kampus dan lowongan kerja, serta terhubung kembali dengan rekan-rekan alumni lainnya.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>