<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('landing');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rute Tampilan Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // BARIS YANG DITAMBAHKAN: Memproses pilihan skema sertifikasi milik user
    Route::post('/dashboard/pilih-skema', [DashboardController::class, 'storeSkema'])->name('dashboard.store-skema');

    // RUTE PROFIL BARU: Menampilkan halaman profil & memproses simpanan perubahan data diri
    Route::get('/profile', [DashboardController::class, 'showProfile'])->name('profile.edit');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');


    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('peserta', PesertaController::class)
            ->except(['index', 'show'])
            ->parameters(['peserta' => 'peserta']);

        Route::resource('skema', SkemaController::class)
            ->except(['index', 'show'])
            ->parameters(['skema' => 'skema']);

        // BARIS BARU DI SINI: Rute untuk memproses konfirmasi status oleh Admin
        Route::post('/peserta/{id}/konfirmasi', [PesertaController::class, 'konfirmasi'])->name('peserta.konfirmasi');
    });


    Route::resource('peserta', PesertaController::class)
        ->only(['index', 'show'])
        ->parameters(['peserta' => 'peserta']);

    Route::resource('skema', SkemaController::class)
        ->only(['index'])
        ->parameters(['skema' => 'skema']);
});
