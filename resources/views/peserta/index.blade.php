@extends('layouts.app')
@section('title', 'Data Peserta')
@section('page-title', 'Data Peserta')
@section('page-subtitle', 'Kelola data peserta sertifikasi')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <form method="GET" class="d-flex gap-2" style="max-width: 420px; width: 100%;">
            <input type="text" name="q" value="{{ $keyword ?? '' }}" class="form-control"
                placeholder="Cari nama atau NIK...">
            <button class="btn btn-primary px-4">Cari</button>
            @if(request('q'))
                <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-secondary">
                        <tr>
                            <th class="py-3 px-4">Nama Peserta</th>
                            <th class="py-3">Skema</th>
                            <th class="py-3">No. HP</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center" style="width: 320px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesertas as $p)
                            <tr>
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $p->nama }}</div>
                                            <div class="text-muted small">NIK: {{ $p->nik }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1 fw-semibold">
                                        {{ $p->skema->nama_skema ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-secondary">{{ $p->no_hp ?? '-' }}</td>

                                {{-- BARIS YANG DITAMBAHKAN: Menampilkan Badge Status --}}
                                <td>
                                    @if($p->status === 'pending')
                                        <span class="badge bg-warning text-dark px-2 py-1">Pending</span>
                                    @elseif($p->status === 'disetujui')
                                        <span class="badge bg-success text-white px-2 py-1">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger text-white px-2 py-1">Ditolak</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        {{-- BARIS YANG DITAMBAHKAN: Tombol Aksi Konfirmasi khusus Admin jika status pending --}}
                                        @if (auth()->user()->isAdmin() && $p->status === 'pending')
                                            <form action="{{ route('peserta.konfirmasi', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="disetujui">
                                                <button type="submit" class="btn btn-sm btn-success px-2 py-1 text-white"
                                                    onclick="return confirm('Yakin ingin MENYETUJUI peserta {{ $p->nama }}?')">
                                                    Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('peserta.konfirmasi', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn btn-sm btn-danger px-2 py-1 text-white"
                                                    onclick="return confirm('Yakin ingin MENOLAK peserta {{ $p->nama }}?')">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('peserta.show', $p) }}"
                                            class="btn btn-sm btn-outline-secondary px-2 py-1" title="Detail">
                                            Detail
                                        </a>
                                        @if (auth()->user()->isAdmin())
                                            <a href="{{ route('peserta.edit', $p) }}"
                                                class="btn btn-sm btn-primary px-2 py-1" title="Ubah">
                                                Ubah
                                            </a>
                                            <form action="{{ route('peserta.destroy', $p) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin hapus data {{ $p->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger px-2 py-1" title="Hapus">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <div class="py-3">
                                        <i class="bi bi-inbox fs-1 text-muted opacity-50 d-block mb-2"></i>
                                        Data peserta tidak ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        {{ $pesertas->withQueryString()->links() }}
    </div>

@endsection
