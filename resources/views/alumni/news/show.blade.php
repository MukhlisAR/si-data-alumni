<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ $news->title }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('alumni.news.index') }}" class="text-blue-600 mb-4 inline-block">&larr; Kembali</a>
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-80 object-cover rounded-lg mb-6">
                @endif
                <div class="text-sm text-slate-500 mb-4">Dipublikasikan pada: {{ $news->created_at->format('d F Y') }}</div>
                <div class="prose max-w-none">{!! nl2br(e($news->content)) !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>