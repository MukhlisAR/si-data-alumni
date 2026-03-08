<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-slate-100 p-8 sm:p-10">
                
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-bold text-slate-700 mb-2">Judul Berita</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $news->title) }}" required autofocus
                            class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-bold text-slate-700 mb-2">Isi Berita</label>
                        <textarea id="content" name="content" rows="8" required
                            class="block w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors bg-slate-50 focus:bg-white">{{ old('content', $news->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-200">
                        <label for="image" class="block text-sm font-bold text-slate-700 mb-4">Ganti Gambar (Opsional)</label>
                        
                        @if($news->image)
                            <div class="mb-4">
                                <p class="text-xs text-slate-500 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $news->image) }}" class="h-40 w-auto rounded-xl object-cover border border-slate-300 shadow-sm">
                            </div>
                        @endif

                        <input type="file" id="image" name="image" 
                            class="block w-full text-sm text-slate-500 
                            file:mr-4 file:py-2.5 file:px-5
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-100 file:text-blue-700
                            hover:file:bg-blue-200 transition-colors cursor-pointer" />
                        <p class="text-xs text-slate-500 mt-3">Format: JPG, PNG. Maksimal ukuran 2MB. <strong>Biarkan kosong jika tidak ingin mengganti gambar.</strong></p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <a href="{{ route('admin.news.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-bold hover:bg-slate-200 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-all hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>