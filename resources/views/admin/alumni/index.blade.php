<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Data Alumni') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    <div class="flex justify-between items-center mb-4">
    <div class="flex gap-2">
        <form action="{{ route('admin.alumni.cetak') }}" method="GET" target="_blank" class="flex items-center gap-2">
          <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold text-slate-800">Daftar Alumni Terdaftar</h3>
                        
                        <div class="flex flex-wrap gap-2 items-center">
                            <a href="{{ route('admin.alumni.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-bold flex items-center shadow-lg transition">
                                + Tambah Alumni
                            </a>

                            <form method="GET" class="flex items-center gap-2">
                                <select name="year" class="border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                                    <option value="">Semua Tahun</option>
                                    @for($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                
                                <button type="submit" formaction="{{ route('admin.alumni.export') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-bold flex items-center shadow-lg shadow-green-600/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Export Excel
                                </button>

                                <button type="submit" formaction="{{ route('admin.alumni.cetak') }}" formtarget="_blank" class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 text-sm font-bold flex items-center shadow-lg shadow-slate-800/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Cetak PDF
                                </button>
                            </form>
                        </div>
                    </div>
        </form>
    </div>
</div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-slate-200">
                            <thead>
                                <tr class="bg-slate-50 text-slate-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Nama Alumni</th>
                                    <th class="py-3 px-6 text-left">NIM</th>
                                    <th class="py-3 px-6 text-left">Jurusan</th>
                                    <th class="py-3 px-6 text-center">Tahun Lulus</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-600 text-sm font-light">
                                @forelse($alumnis as $data)
                                <tr class="border-b border-slate-200 hover:bg-slate-50">
                                    <td class="py-3 px-6 text-left whitespace-nowrap font-medium">
                                        {{ $data->user->name }}
                                        <div class="text-xs text-slate-400">{{ $data->user->email }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $data->nim }}</td>
                                    <td class="py-3 px-6 text-left">{{ $data->major }}</td>
                                    <td class="py-3 px-6 text-center">{{ $data->graduation_year }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @if($data->status == 'verified')
                                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs font-bold">Verified</span>
                                        @elseif($data->status == 'rejected')
                                            <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs font-bold">Rejected</span>
                                        @else
                                            <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs font-bold">Pending</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a href="{{ route('admin.alumni.show', $data->id) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-6 px-6 text-center text-slate-400">
                                        Belum ada data alumni yang masuk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    
                </div>

                
            </div>
            
        </div>
    
    </div>
    
</x-app-layout>