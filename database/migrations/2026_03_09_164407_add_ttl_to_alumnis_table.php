<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom baru.
     */
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {
            // Menambahkan 3 kolom baru setelah kolom nisn
            $table->string('tempat_lahir')->nullable()->after('nisn');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('jenis_kelamin')->nullable()->after('tanggal_lahir');
        });
    }

    /**
     * Kembalikan (hapus) kolom jika migrasi di-rollback.
     */
    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'tanggal_lahir', 'jenis_kelamin']);
        });
    }
};