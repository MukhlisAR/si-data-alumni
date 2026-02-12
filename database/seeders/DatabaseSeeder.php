<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alumni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Password default
            'role' => 'admin',
        ]);

        // 2. Buat Akun ALUMNI (Contoh 1)
        $userAlumni = User::create([
            'name' => 'Budi Santoso',
            'email' => 'alumni@alumni.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
        ]);

        // Buat data detail alumni untuk user di atas
        Alumni::create([
            'user_id' => $userAlumni->id,
            'nim' => '2019001',
            'graduation_year' => 2023,
            'major' => 'Teknik Informatika',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 45, Jakarta',
            'job_title' => 'Software Engineer',
            'company' => 'Tokopedia',
            'status' => 'verified', // Anggap sudah diverifikasi
        ]);

        // 3. Buat Akun ALUMNI (Contoh 2 - Belum Verifikasi)
        $userAlumni2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@alumni.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
        ]);

        Alumni::create([
            'user_id' => $userAlumni2->id,
            'nim' => '2019002',
            'graduation_year' => 2023,
            'major' => 'Sistem Informasi',
            'status' => 'pending', // Status masih menunggu verifikasi admin
        ]);
    }
}