<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tulis Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Judul Berita')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Gambar Utama (Opsional)')" />
                            <input type="file" name="image" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Isi Berita')" />
                            <textarea name="content" rows="10" class="block mt-1 w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required></textarea>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg">Batal</a>
                            <x-primary-button>Publikasikan</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>