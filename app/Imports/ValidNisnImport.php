<?php

namespace App\Imports;


use App\Models\ValidNisn;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ValidNisnImport implements ToModel, WithHeadingRow

{
    public function model(array $row)
    {
        // Mengecek agar tidak ada error jika barisnya kosong
        if (!isset($row['nisn'])) {
            return null;
        }

        // Cek apakah NISN sudah ada agar tidak error duplikat saat import
        $exists = ValidNisn::where('nisn', $row['nisn'])->first();
        if ($exists) {
            return null; // Lewati baris ini jika NISN sudah terdaftar
        }

        return new ValidNisn([
            'nisn' => $row['nisn'],
            'name' => $row['nama'] ?? null, // Mengambil dari kolom excel bernama 'nama'
        ]);
    }
}