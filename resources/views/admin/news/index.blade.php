<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Kelola Berita & Informasi') }}
            </h2>
            <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-bold">
                + Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($news as $item)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-slate-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover" alt="Foto Berita">
                        @else
                            <div class="w-full h-48 bg-slate-200 flex items-center justify-center text-slate-400">No Image</div>
                        @endif
                        
                        <div class="p-5">
                            <h3 class="font-bold text-lg text-slate-800 mb-2 truncate">{{ $item->title }}</h3>
                            <p class="text-slate-500 text-sm mb-4 line-clamp-3">{{ Str::limit($item->content, 100) }}</p>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                                <span class="text-xs text-slate-400">{{ $item->created_at->format('d M Y') }}</span>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-slate-400 bg-white rounded-lg">
                        Belum ada berita yang diposting.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>