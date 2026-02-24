<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alumni;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        // Statistik Sederhana untuk Dashboard
        $totalAlumni = User::where('role', 'alumni')->count();
        $totalVerified = Alumni::where('status', 'verified')->count();
        $totalPending = Alumni::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalAlumni', 'totalVerified', 'totalPending'));
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
}