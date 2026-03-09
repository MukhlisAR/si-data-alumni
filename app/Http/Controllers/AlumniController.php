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
        
        // Aturan Baru: Semua kolom penting HARUS terisi agar statusnya "Lengkap"
        $isComplete = $alumni && 
                      $alumni->nisn && 
                      $alumni->tempat_lahir && 
                      $alumni->tanggal_lahir && 
                      $alumni->jenis_kelamin && 
                      $alumni->graduation_year && 
                      $alumni->major;

        return view('alumni.dashboard', compact('alumni', 'isComplete'));
    }

   // 2. Menampilkan Form Edit Biodata
    public function editBiodata()
    {
        $user = Auth::user();
        
        // Samakan persis dengan logika pemanggilan di Dashboard
        $alumni = $user->alumni ?? new \App\Models\Alumni();
        
        // Ambil data jurusan dari Data Master
        $majors = \App\Models\Major::orderBy('name', 'asc')->get();

        return view('alumni.biodata', compact('user', 'alumni', 'majors'));
    }

 // 3. Menyimpan atau Memperbarui Biodata
    public function updateBiodata(Request $request)
    {
       

        // 1. Validasi Input (Pastikan kolom baru wajib diisi)
        $request->validate([
            'nisn' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'graduation_year' => 'required|digits:4|integer|min:2000|max:'.(date('Y')+1),
            'major' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'job_title' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $alumni = \App\Models\Alumni::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
        $photoPath = $alumni->photo ?? null;

        // 2. Cek Foto
        if ($request->hasFile('photo')) {
            if ($photoPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($photoPath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('alumni-photos', 'public');
        }

        // 3. PROSES SIMPAN KE DATABASE
        \App\Models\Alumni::updateOrCreate(
            ['user_id' => \Illuminate\Support\Facades\Auth::id()], 
            [
                'nisn' => $request->nisn,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'graduation_year' => $request->graduation_year,
                'major' => $request->major,
                'phone' => $request->phone,
                'address' => $request->address,
                'job_title' => $request->job_title,
                'company' => $request->company,
                'photo' => $photoPath,
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

    // 6. Menampilkan Direktori Alumni (Cari Teman)
    public function directory(Request $request)
    {
        $query = Alumni::with('user')->where('status', 'verified');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('year')) {
            $query->where('graduation_year', $request->year);
        }

        $alumnis = $query->paginate(12);
        
        $years = Alumni::where('status', 'verified')
                       ->select('graduation_year')
                       ->distinct()
                       ->orderBy('graduation_year', 'desc')
                       ->pluck('graduation_year');

        return view('alumni.directory', compact('alumnis', 'years'));
    }
}