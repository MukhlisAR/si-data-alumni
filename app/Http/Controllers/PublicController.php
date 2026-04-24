<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News; // Pastikan model berita Anda bernama 'News'

class PublicController extends Controller
{
    // Menampilkan daftar semua berita di halaman publik
    public function newsIndex()
    {
        // Ambil data berita, urutkan dari yang terbaru. (Bisa pakai paginate agar tidak berat)
        $news = News::latest()->paginate(9); 
        return view('public.news.index', compact('news'));
    }

    // Menampilkan detail isi satu berita
    public function newsShow($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('public.news.show', compact('news'));
    }
}