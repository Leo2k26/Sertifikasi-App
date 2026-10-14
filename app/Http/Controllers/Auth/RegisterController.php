<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    // TAMBAHKAN KEMBALI METHOD INI:
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s\.\']+$/', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'nik' => ['required', 'string', 'size:16'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, atau tanda petik.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus berukuran 16 karakter.',
            'no_hp.required' => 'No. HP wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        DB::beginTransaction();

        try {
            $user = User::forceCreate([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => 'user',
                'nik'      => $data['nik'],
                'no_hp'    => $data['no_hp'],
                'alamat'   => $data['alamat'],
            ]);

            DB::commit();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Registrasi berhasil! Silakan tentukan skema sertifikasi Anda.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors([
                'email' => 'Gagal mendaftar karena masalah sistem database: ' . $e->getMessage()
            ]);
        }
    }
}
