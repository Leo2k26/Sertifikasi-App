<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        if ($user->isAdmin()) {
            return redirect()->route('peserta.index');
        }


        $totalPeserta = Peserta::count();
        $totalSkema = Skema::count();
        $pesertaTerbaru = Peserta::with('skema')->latest()->take(5)->get();

        $pesertaAktif = Peserta::where('user_id', $user->id)->first();


        if (!$pesertaAktif) {
            $skemas = Skema::all();
            return view('dashboard.pilih_skema', compact('skemas', 'totalPeserta', 'totalSkema', 'pesertaTerbaru'));
        }


        if ($pesertaAktif->status == 'pending') {
            return view('dashboard.menunggu_konfirmasi', compact('pesertaAktif', 'totalPeserta', 'totalSkema', 'pesertaTerbaru'));
        }

        
        return view('dashboard.dashboard', compact('totalPeserta', 'totalSkema', 'pesertaTerbaru', 'pesertaAktif'));
    }

    public function storeSkema(Request $request)
    {
        $request->validate([
            'skema_id' => 'required|exists:skemas,id'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        Peserta::create([
            'user_id'  => $user->id,
            'skema_id' => $request->skema_id,
            'status'   => 'pending',

            'nik'      => $user->nik,
            'nama'     => $user->name,
            'email'    => $user->email,
            'no_hp'    => $user->no_hp,
            'alamat'   => $user->alamat,
        ]);

        return redirect()->route('dashboard')->with('success', 'Skema berhasil dipilih! Mohon tunggu konfirmasi dari pihak admin.');
    }

    /**
     *
     */
    public function showProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        if ($user->isAdmin()) {
            abort(403, 'Admin tidak memiliki akses ke halaman ubah profil.');
        }

        return view('profile.edit', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        if ($user->isAdmin()) {
            abort(403, 'Action ini dilarang untuk akun Admin.');
        }


        $request->validate([
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s\.\']+$/', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email,' . $user->id],
            'nik' => ['required', 'numeric', 'digits:16', 'unique:users,nik,' . $user->id],
            'no_hp' => ['required', 'numeric', 'digits_between:11,13'],
            'alamat' => ['required', 'string'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, atau tanda petik.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar pada akun lain.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.digits_between' => 'Nomor HP harus di antara 11 sampai 13 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);


        $peserta = Peserta::where('user_id', $user->id)->first();
        if ($peserta) {
            $peserta->update([
                'nama' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
