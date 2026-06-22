<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School; 
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // PENTING: Untuk Transaksi Database

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan tampilan pendaftaran.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Tangani permintaan pendaftaran yang masuk (membuat School dan User).
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi: sekarang termasuk input 'slug' manual
        $request->validate([
    // Sesuaikan dengan name="" yang ada di file register.blade.php Anda
    'name' => ['required', 'string', 'max:255'], 
    'npsn' => ['nullable', 'string', 'max:8', 'unique:schools,npsn'], // Tambahkan NPSN
    'slug' => ['required', 'string', 'max:255', 'unique:schools,slug', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
    'admin_name' => ['required', 'string', 'max:255'], 
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);

        // Menggunakan transaksi untuk memastikan kedua operasi (School & User) sukses atau gagal bersamaan
        $user = DB::transaction(function () use ($request) {
    // 1. Buat Sekolah
    $school = School::create([
        'name' => $request->name, // Ambil dari input "Nama Sekolah"
        'npsn' => $request->npsn, // Pastikan kolom npsn ada di DB
        'slug' => $request->slug,
        'is_active' => true,
    ]);

    // 2. Buat User Admin
    return User::create([
        'name' => $request->admin_name, // Ambil dari input "Nama Admin"
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'school_id' => $school->id, 
        'role' => 'admin_sekolah',
    ]);
});

        event(new Registered($user));
        Auth::login($user);

        // Redirect absolut ke Admin Panel (/admin)
        return redirect()->to('/admin') 
            ->with('status', 'Pendaftaran sekolah berhasil! Silakan kelola konten Anda.');
    }
}