<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Alumni;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    { // 1. Data Statistik Angka (Card)
        $totalAlumni = User::where('role', 'alumni')->count();
        $totalVerified = Alumni::where('status', 'verified')->count();
        $totalPending = Alumni::where('status', 'pending')->count();

        // 2. Data Grafik 1: Status Alumni (Pie Chart)
        // Hasil: ['verified' => 10, 'pending' => 5, 'rejected' => 2]
        $statusData = Alumni::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // 3. Data Grafik 2: Alumni per Tahun Lulus (Bar Chart)
        // Hasil: ['2020' => 50, '2021' => 75, '2022' => 100]
        $yearData = Alumni::select('graduation_year', DB::raw('count(*) as total'))
             ->where('status', 'verified') // Hanya hitung yang verified
             ->groupBy('graduation_year')
             ->orderBy('graduation_year', 'asc')
             ->pluck('total', 'graduation_year');

        return view('admin.dashboard', compact(
            'totalAlumni', 'totalVerified', 'totalPending', 
            'statusData', 'yearData'
        ));
    }

    public function alumniIndex()
    {
        // Ambil data alumni yang SUDAH mengisi biodata, urutkan yang terbaru
        $alumnis = Alumni::with('user')->latest()->get();
        return view('admin.alumni.index', compact('alumnis'));
    }

    public function alumniShow($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('admin.alumni.show', compact('alumni'));
    }

    public function verify(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);
        
        // Validasi input status harus 'verified' atau 'rejected'
        $request->validate([
            'status' => 'required|in:verified,rejected'
        ]);

        $alumni->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status alumni berhasil diperbarui!');
    }
    // === TAMBAHKAN FUNGSI CETAK INI ===
    public function cetakPdf(Request $request)
    {
        // Ambil filter tahun dari request (jika ada)
        $year = $request->input('year');

        // Siapkan Query: Ambil alumni yang statusnya 'verified' beserta data user-nya
        $query = Alumni::with('user')->where('status', 'verified');

        // Jika ada filter tahun, tambahkan kondisi where
        if ($year) {
            $query->where('graduation_year', $year);
        }

        // --- BAGIAN PERBAIKAN ---
        // Kita ambil dulu datanya (get), BARU kita urutkan berdasarkan nama user (sortBy)
        // Cara ini aman karena 'name' ada di tabel relasi (users), bukan di tabel alumni.
        $alumnis = $query->get()->sortBy(function($alumni) {
            return $alumni->user->name;
        });
        // ------------------------

        // Load view khusus PDF
        $pdf = Pdf::loadView('admin.alumni.pdf', compact('alumnis', 'year'));

        // Download file PDF
        return $pdf->stream('Buku-Wisuda-' . ($year ?? 'Semua') . '.pdf');
    }
   
    // ==================================================
    // FITUR TAMBAH ALUMNI MANUAL OLEH ADMIN
    // ==================================================

    // 1. Menampilkan Form Tambah Alumni
   
    public function create()
    {
        $majors = \App\Models\Major::orderBy('name', 'asc')->get(); 
        return view('admin.alumni.create', compact('majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nisn' => 'required|string|max:20|unique:alumnis', // <-- NISN
            'graduation_year' => 'required|digits:4|integer',
            'major' => 'required|string',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make('password'), 
            'role' => 'alumni',
        ]);

        \App\Models\Alumni::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn, // <-- NISN
            'graduation_year' => $request->graduation_year,
            'major' => $request->major,
            'status' => 'verified',
        ]);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil ditambahkan! Password default: password');
    }
    // ==================================================
    // FITUR CETAK PDF BUKU KENANGAN ALUMNI
    // ==================================================
    public function pdf()
    {
        // Ambil data alumni yang sudah diverifikasi (verified)
        $alumnis = \App\Models\Alumni::with('user')->where('status', 'verified')->get();

        // Load tampilan dari file resources/views/admin/alumni/pdf.blade.php
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.alumni.pdf', compact('alumnis'));

        // Tampilkan hasilnya langsung di browser
        return $pdf->stream('buku-kenangan-alumni.pdf');
    
        
        }
   // ==================================================
    // FITUR EXPORT EXCEL (CSV)
    // ==================================================
    public function exportExcel()
    {
        $fileName = 'Data_Alumni_' . date('Y-m-d_H-i-s') . '.csv';
        $alumnis = \App\Models\Alumni::with('user')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Nama Lengkap', 'NISN', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Tahun Lulus', 'Jurusan', 'Status', 'Pekerjaan', 'Instansi', 'No. HP', 'Alamat'];

        $callback = function() use($alumnis, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $rowCounter = 1;
            foreach ($alumnis as $alumni) {
                fputcsv($file, [
                    $rowCounter++, 
                    $alumni->user->name ?? '-', 
                    $alumni->nisn ?? '-', 
                    $alumni->tempat_lahir ?? '-', 
                    $alumni->tanggal_lahir ?? '-', 
                    $alumni->jenis_kelamin ?? '-', 
                    $alumni->graduation_year ?? '-', 
                    $alumni->major ?? '-', 
                    $alumni->status ?? '-', 
                    $alumni->job_title ?? '-', 
                    $alumni->company ?? '-', 
                    $alumni->phone ?? '-', 
                    $alumni->address ?? '-'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    

    // Tampilan Master Data Angkatan
    public function academicYears()
    {
        $years = \App\Models\AcademicYear::orderBy('year_name', 'desc')->get();
        return view('admin.academic_years.index', compact('years'));
    }

    // Simpan Angkatan Baru
    public function storeAcademicYear(Request $request)
    {
        $request->validate(['year_name' => 'required|string|unique:academic_years,year_name']);
        \App\Models\AcademicYear::create(['year_name' => $request->year_name]);
        return back()->with('success', 'Tahun Angkatan berhasil ditambahkan!');
    }

    // Hapus Angkatan
    public function destroyAcademicYear($id)
    {
        \App\Models\AcademicYear::findOrFail($id)->delete();
        return back()->with('success', 'Tahun Angkatan berhasil dihapus!');
    }
    
}