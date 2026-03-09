<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Kelola Data Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

           <div class="mb-4 flex flex-col sm:flex-row justify-between gap-3">
                <a href="{{ route('admin.alumni.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow text-center">
                    + Tambah Alumni Manual
                </a>
                
                <div class="flex gap-2">
                    <a href="{{ route('admin.alumni.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Export Excel
                    </a>
                    
                    <a href="{{ route('admin.alumni.pdf') }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                        Cetak PDF
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-left font-bold border-b border-gray-200">
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">NISN</th>
                                <th class="px-4 py-3">Lulusan</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnis as $alumni)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $alumni->user->name ?? 'User Terhapus' }}</td>
                                <td class="px-4 py-3">{{ $alumni->nisn ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $alumni->graduation_year ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($alumni->status == 'verified')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">Verified</span>
                                    @elseif($alumni->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">Pending</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center flex justify-center gap-2">
                                    <a href="{{ route('admin.alumni.show', $alumni->id) }}" class="text-blue-500 hover:underline">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>