<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        // 1. Validasi Input (Tambahkan validasi untuk foto)
        $request->validate([
            'nim' => 'required|string|max:20',
            'graduation_year' => 'required|digits:4|integer|min:2000|max:'.(date('Y')+1),
            'major' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'job_title' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $alumni = Alumni::where('user_id', Auth::id())->first();
        $photoPath = $alumni->photo ?? null; // Gunakan foto lama jika ada

        // 2. Cek apakah ada file foto yang diupload
        if ($request->hasFile('photo')) {
            // Hapus foto lama dari storage jika ada
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            // Simpan foto baru ke folder 'alumni-photos'
            $photoPath = $request->file('photo')->store('alumni-photos', 'public');
        }

        // 3. Simpan ke Database
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
                'photo' => $photoPath, // Simpan path foto
            ]
        );

        return redirect()->route('alumni.biodata')->with('success', 'Biodata dan Foto berhasil diperbarui!');
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

    // 6. Menampilkan Direktori Alumni (Cari Teman)
    public function directory(Request $request)
    {
        // Hanya tampilkan yang statusnya verified
        $query = Alumni::with('user')->where('status', 'verified');

        // Fitur Pencarian Nama
        if ($request->filled('search')) {
            $search = $request->search;
            // Cari ke tabel users (karena nama ada di tabel users)
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        // Fitur Filter Tahun Lulus
        if ($request->filled('year')) {
            $query->where('graduation_year', $request->year);
        }

        // Gunakan pagination agar halaman tidak berat jika data ribuan
        $alumnis = $query->paginate(12);
        
        // Ambil daftar tahun lulus unik untuk dropdown filter
        $years = Alumni::where('status', 'verified')
                       ->select('graduation_year')
                       ->distinct()
                       ->orderBy('graduation_year', 'desc')
                       ->pluck('graduation_year');

        return view('alumni.directory', compact('alumnis', 'years'));
    }
}