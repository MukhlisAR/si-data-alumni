<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ __('Berita & Karir') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($news as $item)
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-slate-200 flex items-center justify-center text-slate-500">No Image</div>
                        @endif
                        <div class="p-5">
                            <span class="text-xs text-blue-600 font-bold">{{ $item->created_at->format('d M Y') }}</span>
                            <h3 class="font-bold text-lg mt-1 mb-2">{{ $item->title }}</h3>
                            <p class="text-slate-500 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            <a href="{{ route('alumni.news.show', $item->slug) }}" class="text-blue-600 font-bold text-sm hover:underline">Baca Selengkapnya &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 bg-white rounded-lg border border-slate-200 text-slate-500">
                        Belum Ada Berita. Informasi terbaru akan muncul di sini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>