<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Http;

class AdminBroadcastController extends Controller
{
    // ==========================================================
    // 1. MENAMPILKAN HALAMAN FORM BROADCAST & HASIL FILTER
    // ==========================================================
    public function index(Request $request)
    {
        $years = Alumni::select('graduation_year')
                       ->whereNotNull('graduation_year')
                       ->distinct()
                       ->orderBy('graduation_year', 'desc')
                       ->pluck('graduation_year');

        $targets = collect(); 
        $totalPenerima = 0;

        if ($request->has('filter')) {
            $query = Alumni::with('user')
                           ->where('status', 'verified')
                           ->whereNotNull('phone')
                           ->where('phone', '!=', '');

            if ($request->filled('year')) {
                $query->where('graduation_year', $request->year);
            }

            $targets = $query->get();
            $totalPenerima = $targets->count();
        }

        return view('admin.broadcast.index', compact('years', 'targets', 'totalPenerima'));
    }

    // ==========================================================
    // 2. EKSEKUSI PENGIRIMAN PESAN MASSAL VIA FONNTE
    // ==========================================================
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        $query = Alumni::with('user')
                       ->where('status', 'verified')
                       ->whereNotNull('phone')
                       ->where('phone', '!=', '');

        if ($request->filled('year')) {
            $query->where('graduation_year', $request->year);
        }

        $alumnis = $query->get();

        if ($alumnis->isEmpty()) {
            return back()->withErrors(['Tidak ada target yang valid untuk dikirim.']);
        }

        // 1. Siapkan Format Target Fonnte (nomor|nama, nomor|nama)
        $targetsArray = [];
        foreach ($alumnis as $alumni) {
            $nama = $alumni->user->name ?? 'Alumni';
            // Fonnte melarang ada koma di dalam nama, jadi kita ubah koma menjadi spasi
            $namaBersih = str_replace(',', ' ', $nama);
            
            // Gabungkan nomor dan nama dipisah dengan garis vertikal |
            $targetsArray[] = $alumni->phone . '|' . $namaBersih;
        }

        // Gabungkan semuanya menjadi satu teks panjang yang dipisah koma
        $targetString = implode(',', $targetsArray);

        // 2. Ubah format {name} dari user menjadi {1} sesuai aturan sistem Fonnte
        $pesanFonnte = str_replace('{name}', '{1}', $request->message);

        // Token Asli Fonnte Anda
        $token = '6eawTo3FcmEpjEovdMCx'; 

        try {
            // 3. Tembak menggunakan format asForm() agar diakui oleh Fonnte
            $response = Http::withoutVerifying()
                ->asForm() // <--- KUNCI PENYELESAIAN MASALAHNYA DI SINI
                ->withHeaders([
                    'Authorization' => $token,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $targetString,
                    'message' => $pesanFonnte,
                    'delay' => '2',
                    'countryCode' => '62',
                ]);

            if ($response->successful() && $response->json('status') == true) {
                return back()->with('success', 'Pesan Broadcast berhasil masuk ke antrean Fonnte untuk ' . count($targetsArray) . ' alumni!');
            } else {
                $pesanError = $response->json('reason') ?? $response->json('detail') ?? 'Terjadi kesalahan pada Fonnte.';
                return back()->withErrors(['Gagal mengirim! Respon Fonnte: ' . $pesanError]);
            }

        } catch (\Exception $e) {
            return back()->withErrors(['Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}