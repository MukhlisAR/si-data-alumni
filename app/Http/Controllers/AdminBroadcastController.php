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
    // 2. EKSEKUSI PENGIRIMAN MASSAL (METODE SATU PER SATU / LOOPING)
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

        $token = '6eawTo3FcmEpjEovdMCx'; 
        
        // Siapkan variabel untuk menghitung sukses dan gagal
        $berhasil = 0;
        $gagal = 0;

        foreach ($alumnis as $alumni) {
            // 1. Bersihkan Nomor WA
            $noWaBersih = preg_replace('/[^0-9]/', '', $alumni->phone);
            
            // 2. Format standar Fonnte (08...)
            if (substr($noWaBersih, 0, 2) === '62') {
                $noWaBersih = '0' . substr($noWaBersih, 2);
            } elseif (substr($noWaBersih, 0, 1) === '8') {
                $noWaBersih = '0' . $noWaBersih;
            }

            // Validasi: Jika nomor cukup panjang
            if (strlen($noWaBersih) >= 10) {
                
                $nama = $alumni->user->name ?? 'Alumni';
                // Ubah kata {name} secara otomatis per alumni
                $pesanPersonal = str_replace('{name}', trim($nama), $request->message);

                try {
                    // Tembak API Fonnte SATU PER SATU
                    $response = Http::withoutVerifying()
                        ->asForm()
                        ->withHeaders([
                            'Authorization' => $token,
                        ])->post('https://api.fonnte.com/send', [
                            'target' => $noWaBersih,
                            'message' => $pesanPersonal,
                            'delay' => '2' // Delay sangat penting agar WA Anda tidak diblokir
                        ]);

                    // Jika sukses masuk Fonnte, tambah angka berhasil
                    if ($response->successful() && $response->json('status') == true) {
                        $berhasil++;
                    } else {
                        $gagal++;
                    }
                } catch (\Exception $e) {
                    $gagal++;
                }
            } else {
                // Jika nomor di bawah 10 digit, langsung catat sebagai gagal
                $gagal++;
            }
        }

        // ==========================================================
        // EVALUASI HASIL PENGIRIMAN
        // ==========================================================
        if ($berhasil > 0) {
            return back()->with('success', "Selesai! Pesan berhasil dikirim ke {$berhasil} alumni. (Gagal: {$gagal} alumni karena nomor tidak valid/tidak terdaftar WA).");
        } else {
            return back()->withErrors(["Gagal total! Seluruh nomor alumni pada target ini tidak valid atau ditolak oleh Fonnte."]);
        }
    }
}