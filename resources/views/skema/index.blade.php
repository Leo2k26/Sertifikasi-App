@extends('layouts.app')
@section('title', 'Data Skema')
@section('page-title', 'Data Skema Sertifikasi')
@section('page-subtitle', 'Kelola daftar skema sertifikasi')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <form method="GET" class="d-flex gap-2 flex-grow-1" style="max-width: 420px;">
            <input type="text" name="q" value="{{ $keyword ?? '' }}" class="form-control"
                placeholder="Cari Skema...">
            <button class="btn btn-primary px-4">Cari</button>
            @if(request('q'))
                <a href="{{ route('skema.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('skema.create') }}" class="btn btn-primary">+ Tambah Skema</a>
        @endif
    </div>

    <div class="card-box">
        <div class="table-responsive">
            <table class="table table-app align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Skema</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Peserta</th>
                        @if (auth()->user()->isAdmin())
                            <th class="text-end" style="width:170px">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($skemas as $s)
                        <tr>
                            <td>{{ $s->kode_skema }}</td>
                            <td>{{ $s->nama_skema }}</td>
                            <td>{{ $s->deskripsi }}</td>
                            <td class="text-center">{{ $s->pesertas_count }}</td>
                            @if (auth()->user()->isAdmin())
                                <td class="text-end">
                                    <a href="{{ route('skema.edit', $s) }}" class="btn btn-sm btn-primary">Ubah</a>
                                    <form action="{{ route('skema.destroy', $s) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus skema {{ $s->nama_skema }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" class="text-center text-muted py-4">
                                Belum ada data skema.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $skemas->links() }}
    </div>

@endsection
