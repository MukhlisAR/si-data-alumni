<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Validasi diubah: Wajib ada di tabel valid_nisns, dan belum dipakai di tabel users
            'nisn' => ['required', 'string', 'max:20', 'exists:valid_nisns,nisn', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Pesan error custom (Opsional tapi bagus)
            'nisn.exists' => 'NISN ini tidak terdaftar di database sekolah. Silakan hubungi Admin.',
            'nisn.unique' => 'Akun dengan NISN ini sudah pernah didaftarkan.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nisn' => $request->nisn, // Menggunakan nisn
            'password' => Hash::make($request->password),
            'role' => 'alumni', // Otomatis jadi alumni
        ]);

        // Opsional: Langsung buatkan kerangka data di tabel alumnis
        \App\Models\Alumni::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn,
            'status' => 'pending' // atau verified
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('alumni.dashboard', absolute: false));
    }
}
