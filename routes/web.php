<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminMajorController;
use App\Http\Controllers\AdminBroadcastController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. Halaman Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Logika Redirect Saat Login (Admin vs Alumni)
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('alumni.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// 3. GROUP ROUTE ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Fitur Cetak & Export
    Route::get('/alumni/pdf', [AdminController::class, 'pdf'])->name('alumni.pdf');
    Route::get('/alumni/cetak', [AdminController::class, 'cetakPdf'])->name('alumni.cetak');
    Route::get('/alumni/export', [AdminController::class, 'exportExcel'])->name('alumni.export');
    
    // Kelola Alumni
    Route::get('/alumni', [AdminController::class, 'alumniIndex'])->name('alumni.index');
    Route::get('/alumni/create', [AdminController::class, 'create'])->name('alumni.create');
    Route::post('/alumni', [AdminController::class, 'store'])->name('alumni.store');
    Route::get('/alumni/{id}', [AdminController::class, 'alumniShow'])->name('alumni.show');
    Route::patch('/alumni/{id}/verify', [AdminController::class, 'verify'])->name('alumni.verify');
    
    // Master Data: Tahun Angkatan
    Route::get('/academic-years', [AdminController::class, 'academicYears'])->name('academic_years.index');
    Route::post('/academic-years', [AdminController::class, 'storeAcademicYear'])->name('academic_years.store');
    Route::delete('/academic-years/{id}', [AdminController::class, 'destroyAcademicYear'])->name('academic_years.destroy');
    
    // Kelola NISN Valid (Whitelist & Import)
    Route::get('/valid-nisns', [AdminController::class, 'validNisnsIndex'])->name('valid_nisns.index');
    Route::post('/valid-nisns', [AdminController::class, 'storeValidNisn'])->name('valid_nisns.store');
    Route::delete('/valid-nisns/{id}', [AdminController::class, 'destroyValidNisn'])->name('valid_nisns.destroy');
    Route::post('/valid-nisn/import', [AdminController::class, 'importNisn'])->name('valid_nisn.import');
    
    // Kelola Berita
    Route::resource('news', AdminNewsController::class);
    
    // Data Master (Jurusan)
    Route::get('/majors', [AdminMajorController::class, 'index'])->name('majors.index');
    Route::post('/majors', [AdminMajorController::class, 'store'])->name('majors.store');
    Route::delete('/majors/{id}', [AdminMajorController::class, 'destroy'])->name('majors.destroy');
    
    // Broadcast WA
    Route::get('/broadcast', [AdminBroadcastController::class, 'index'])->name('broadcast.index');
});


// ==========================================
// 4. GROUP ROUTE ALUMNI
// ==========================================
Route::middleware(['auth', 'role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
    
    // Dashboard Alumni
    Route::get('/dashboard', [AlumniController::class, 'index'])->name('dashboard');
    
    // Kelola Biodata
    Route::get('/biodata', [AlumniController::class, 'editBiodata'])->name('biodata');
    Route::patch('/biodata', [AlumniController::class, 'updateBiodata'])->name('biodata.update');
    
    // Baca Berita
    Route::get('/berita', [AlumniController::class, 'newsIndex'])->name('news.index');
    Route::get('/berita/{slug}', [AlumniController::class, 'newsShow'])->name('news.show');

    // Direktori
    Route::get('/direktori', [AlumniController::class, 'directory'])->name('directory');
    Route::get('/direktori/{id}', [AlumniController::class, 'showAlumni'])->name('directory.show');
});


// ==========================================
// 5. ROUTE BAWAAN BREEZE (Profile & Auth)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';