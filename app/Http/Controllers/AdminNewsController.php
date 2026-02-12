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
}