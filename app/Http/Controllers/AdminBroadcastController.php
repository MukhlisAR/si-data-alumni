<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\Major;

class AdminBroadcastController extends Controller
{
    public function index(Request $request)
    {
        $majors = Major::all();
        
        // Ambil tahun-tahun unik yang ada di database
        $years = Alumni::select('graduation_year')
                        ->whereNotNull('graduation_year')
                        ->distinct()
                        ->orderBy('graduation_year', 'desc')
                        ->pluck('graduation_year');

        $targets = collect(); // Kosongkan target awal

        // Jika tombol "Cari Target" atau "Generate" diklik
        if ($request->has('filter')) {
            $query = Alumni::with('user')->where('status', 'verified')->whereNotNull('phone');

            if ($request->filled('major_id')) {
                // Cari berdasarkan nama jurusan (karena di tabel alumni kita simpan string nama jurusan)
                $majorName = Major::find($request->major_id)->name ?? '';
                $query->where('major', $majorName);
            }

            if ($request->filled('year')) {
                $query->where('graduation_year', $request->year);
            }

            $targets = $query->get()->map(function($item) {
                // Format Nomor HP: Ubah 08... atau +62... menjadi 62...
                $phone = preg_replace('/[^0-9]/', '', $item->phone); // Hapus karakter selain angka
                
                if (substr($phone, 0, 2) == '08') {
                    $phone = '62' . substr($phone, 1);
                }
                
                $item->formatted_phone = $phone;
                return $item;
            });
        }

        return view('admin.broadcast.index', compact('majors', 'years', 'targets'));
    }
}