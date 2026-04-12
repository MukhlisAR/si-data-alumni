<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('valid_nisns', function (Blueprint $table) {
        $table->id();
        $table->string('nisn')->unique();
        $table->string('name')->nullable(); // Opsional, agar Admin tahu ini NISN milik siapa
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valid_nisns');
    }
};
