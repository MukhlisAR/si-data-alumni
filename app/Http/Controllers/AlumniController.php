<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumni;
use App\Models\Major;
use App\Models\News;

class AlumniController extends Controller
{
    // 1. Menampilkan Dashboard Alumni
    public function index()
    {
        $alumni = Auth::user()->alumni;
        
        // Cek apakah data utama sudah diisi
        $isComplete = $alumni && $alumni->nim && $alumni->graduation_year && $alumni->major;

        return view('alumni.dashboard', compact('alumni', 'isComplete'));
    }

    // 2. Menampilkan Form Edit Biodata
    public function editBiodata()
    {
        $user = Auth::user();
        
        // Jika data alumni belum ada di database, buat object kosong agar view tidak error
        $alumni = $user->alumni ?? new Alumni();
        
        // Ambil data jurusan dari Data Master
        $majors = Major::orderBy('name', 'asc')->get();

        return view('alumni.biodata', compact('user', 'alumni', 'majors'));
    }

    // 3. Menyimpan atau Memperbarui Biodata
    public function updateBiodata(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'graduation_year' => 'required|digits:4|integer|min:2000|max:'.(date('Y')+1),
            'major' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'job_title' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
        ]);

        // Gunakan updateOrCreate: Buat baru jika belum ada, update jika sudah ada
        Alumni::updateOrCreate(
            ['user_id' => Auth::id()], 
            [
                'nim' => $request->nim,
                'graduation_year' => $request->graduation_year,
                'major' => $request->major,
                'phone' => $request->phone,
                'address' => $request->address,
                'job_title' => $request->job_title,
                'company' => $request->company,
                // Kolom status tidak kita update di sini, biarkan default 'pending' atau tetap yang lama
            ]
        );

        return redirect()->route('alumni.biodata')->with('success', 'Biodata berhasil diperbarui!');
    }

    // 4. Menampilkan Daftar Berita untuk Alumni
    public function newsIndex()
    {
        $news = News::latest()->get();
        return view('alumni.news.index', compact('news'));
    }

    // 5. Menampilkan Detail Berita
    public function newsShow($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('alumni.news.show', compact('news'));
    }
}