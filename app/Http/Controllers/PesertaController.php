<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;
        $pesertas = Peserta::with('skema')->cari($keyword)->latest()->paginate(10)->withQueryString();

        return view('peserta.index', compact('pesertas', 'keyword'));
    }

    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Peserta::create($data);

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil ditambahkan.');
    }

    public function show(Peserta $peserta)
    {
        $peserta->load('skema');
        return view('peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $data = $this->validateData($request, $peserta->id);
        $peserta->update($data);

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diubah.');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus.');
    }

    /**
     * BARIS YANG DITAMBAHKAN: Memproses konfirmasi status oleh Admin
     */
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update([
            'status' => $request->status
        ]);

        $pesan = $request->status === 'disetujui'
            ? 'Pendaftaran peserta berhasil disetujui.'
            : 'Pendaftaran peserta ditolak.';

        return redirect()->back()->with('success', $pesan);
    }

    private function validateData(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'nik' => ['required', 'numeric', 'digits:16', 'unique:pesertas,nik,' . $ignoreId],
            'nama' => ['required', 'string', 'regex:/^[a-zA-Z\s\.\']+$/', 'max:100'],
            'email' => ['required', 'email'],
            'no_hp' => ['required', 'numeric', 'digits_between:11,13'],
            'alamat' => ['nullable', 'string'],
            'skema_id' => ['required', 'exists:skemas,id'],
        ], [
            // Validasi NIK
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',

            // Validasi Nama
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, atau tanda petik.',

            // Validasi Email
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid (pastikan menggunakan "@" dan ekstensi seperti .com).',

            // Validasi No HP
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus di antara 11 sampai 13 digit.',

            // Validasi Skema
            'skema_id.required' => 'Skema sertifikasi wajib dipilih.',
            'skema_id.exists' => 'Skema yang dipilih tidak valid.',
        ]);
    }
}
