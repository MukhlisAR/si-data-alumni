<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
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
    // === TAMBAHKAN FUNGSI EXPORT EXCEL (CSV) INI ===
    public function exportExcel(Request $request)
    {
        $year = $request->input('year');

        // Query data alumni verified
        $query = Alumni::with('user')->where('status', 'verified');
        if ($year) {
            $query->where('graduation_year', $year);
        }
        
        // Ambil dan urutkan berdasarkan nama
        $alumnis = $query->get()->sortBy(function($alumni) {
            return $alumni->user->name;
        });

        // Nama file saat didownload
        $fileName = 'Data_Alumni_' . ($year ?? 'Semua_Angkatan') . '_' . date('Y-m-d') . '.csv';

        // Header HTTP agar browser mengenali ini sebagai file download Excel/CSV
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Judul Kolom (Baris Pertama Excel)
        $columns = ['No', 'Nama Lengkap', 'NIM', 'Jurusan', 'Tahun Lulus', 'Pekerjaan', 'Perusahaan', 'No Telp/WA', 'Alamat'];

        // Proses tulis data ke file secara langsung (Streaming)
        $callback = function() use($alumnis, $columns) {
            // Buka akses output file
            $file = fopen('php://output', 'w');
            
            // Tambahkan BOM (Byte Order Mark) agar Excel membaca karakter khusus dengan benar
            fputs($file, "\xEF\xBB\xBF");
            
            // Tulis baris judul kolom
            fputcsv($file, $columns);

            $rowNo = 1;
            // Looping data alumni dan tulis ke baris Excel
            foreach ($alumnis as $alumni) {
                fputcsv($file, [
                    $rowNo++,
                    $alumni->user->name,
                    $alumni->nim,
                    $alumni->major,
                    $alumni->graduation_year,
                    $alumni->job_title ?? '-',
                    $alumni->company ?? '-',
                    $alumni->phone ?? '-',
                    $alumni->address ?? '-'
                ]);
            }
            fclose($file);
        };

        // Kirim response download ke browser
        return response()->stream($callback, 200, $headers);
    }
}