<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Data Akademik
            $table->string('nim')->unique()->nullable();
            $table->year('graduation_year')->nullable(); // Tahun Lulus
            $table->string('major')->nullable(); // Jurusan
            
            // Data Pribadi & Kontak
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            
            // Data Pekerjaan (Opsional, untuk fitur tracking alumni)
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            
            // Status Verifikasi (pending, verified, rejected)
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};