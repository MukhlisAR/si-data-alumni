<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    // 1. Tampilkan Daftar Berita
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    // 2. Tampilkan Form Tambah Berita
    public function create()
    {
        return view('admin.news.create');
    }

    // 3. Simpan Berita ke Database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/news'
            $imagePath = $request->file('image')->store('news', 'public');
        }

        News::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title), // Judul: "Loker BUMN" -> Slug: "loker-bumn"
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    // 4. Hapus Berita
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
    // 1. Menampilkan Form Edit Berita
    public function edit($id)
    {
        // Cari berita berdasarkan ID
        $news = \App\Models\News::findOrFail($id);
        
        // Tampilkan halaman edit dan kirim data berita tersebut
        return view('admin.news.edit', compact('news'));
    }

    // 2. Memproses Perubahan Data Berita
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        $news = \App\Models\News::findOrFail($id);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            // Opsional: Perbarui slug jika judul berubah
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . time(),
        ];

        // Cek apakah admin mengupload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($news->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('news-images', 'public');
        }

        // Simpan pembaruan ke database
        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }
}