<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-slate-500 text-sm font-medium uppercase">Total Alumni</div>
                    <div class="text-3xl font-bold text-slate-800 mt-2">{{ $totalAlumni ?? 0 }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-slate-500 text-sm font-medium uppercase">Terverifikasi</div>
                    <div class="text-3xl font-bold text-slate-800 mt-2">{{ $totalVerified ?? 0 }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-slate-500 text-sm font-medium uppercase">Menunggu Verifikasi</div>
                    <div class="text-3xl font-bold text-slate-800 mt-2">{{ $totalPending ?? 0 }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    <h3 class="font-bold text-lg mb-2">Selamat Datang, Admin!</h3>
                    <p class="text-slate-500">
                        Anda berada di halaman utama administrator. Gunakan menu navigasi untuk mengelola data alumni dan berita.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>