<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;

        $skemas = Skema::withCount('pesertas')
        ->cariSkema($keyword)
        ->orderBy('nama_skema')
        ->paginate(10);


        return view('skema.index', compact('skemas', 'keyword'));
    }

    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Skema::create($data);

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil ditambahkan.');
    }

    public function edit(Skema $skema)
    {
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, Skema $skema)
    {
        $data = $this->validateData($request, $skema->id);
        $skema->update($data);

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil diubah.');
    }

    public function destroy(Skema $skema)
    {
        try {
            $skema->delete();
            return redirect()->route('skema.index')->with('success', 'Data skema berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('skema.index')
                ->with('error', 'Skema tidak dapat dihapus karena masih digunakan oleh data peserta.');
        }
    }

    private function validateData(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'kode_skema' => ['required', 'string', 'max:20', 'unique:skemas,kode_skema,' . $ignoreId],
            'nama_skema' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'kode_skema.required' => 'Kode skema wajib diisi.',
            'kode_skema.unique' => 'Kode skema sudah digunakan.',
            'nama_skema.required' => 'Nama skema wajib diisi.',
        ]);
    }
}
