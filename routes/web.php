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

     // Route Cetak Buku Wisuda (PDF)
    Route::get('/alumni/cetak', [AdminController::class, 'cetakPdf'])->name('alumni.cetak');
    
    // Fitur Manajemen Alumni
    Route::get('/alumni', [AdminController::class, 'alumniIndex'])->name('alumni.index'); // Lihat Daftar
    Route::get('/alumni/{id}', [AdminController::class, 'alumniShow'])->name('alumni.show'); // Lihat Detail
    Route::patch('/alumni/{id}/verify', [AdminController::class, 'verify'])->name('alumni.verify'); // Aksi Verifikasi

    // Fitur Berita
    Route::resource('news', \App\Http\Controllers\AdminNewsController::class);


    // Data Master (Jurusan)
    Route::get('/majors', [\App\Http\Controllers\AdminMajorController::class, 'index'])->name('majors.index');
    Route::post('/majors', [\App\Http\Controllers\AdminMajorController::class, 'store'])->name('majors.store');
    Route::delete('/majors/{id}', [\App\Http\Controllers\AdminMajorController::class, 'destroy'])->name('majors.destroy');

});
require __DIR__.'/auth.php';
