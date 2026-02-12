<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// --- GROUP ROUTE ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Fitur Manajemen Alumni
    Route::get('/alumni', [AdminController::class, 'alumniIndex'])->name('alumni.index'); // Lihat Daftar
    Route::get('/alumni/{id}', [AdminController::class, 'alumniShow'])->name('alumni.show'); // Lihat Detail
    Route::patch('/alumni/{id}/verify', [AdminController::class, 'verify'])->name('alumni.verify'); // Aksi Verifikasi

    // Fitur Berita
    Route::resource('news', \App\Http\Controllers\AdminNewsController::class);
});
require __DIR__.'/auth.php';
