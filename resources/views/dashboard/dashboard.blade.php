@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data peserta dan skema sertifikasi')

@section('content')

    {{-- Statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="stat-card p-4 border rounded-3 bg-white shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small text-uppercase fw-bold mb-1">Total Peserta</div>
                    <div class="stat-card__value fs-2 fw-bold text-primary">{{ $totalPeserta }}</div>
                </div>
                <div class="fs-1 text-primary opacity-25">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card p-4 border rounded-3 bg-white shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small text-uppercase fw-bold mb-1">Total Skema Sertifikasi</div>
                    <div class="stat-card__value fs-2 fw-bold text-success">{{ $totalSkema }}</div>
                </div>
                <div class="fs-1 text-success opacity-25">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-4">
            @if ($pesertaAktif->status === 'ditolak')
                <div class="ucapan-card p-4 border rounded-3 bg-danger text-white shadow-sm h-100 d-flex flex-column justify-content-center">
                    <h3 class="h5 fw-bold mb-2">Mohon Maaf,{{ auth()->user()->name }}!</h3>
                    <p class="mb-0 small text-white opacity-75">Anda telah ditolak oleh admin.</p>
                    <hr class="border-white opacity-25 my-3">
                    <div class="small">
                        <span class="d-block opacity-75">Skema yang Sebelumnya Diajukan:</span>
                        <strong class="fs-6 text-white">{{ $pesertaAktif->skema->nama_skema ?? '-' }}</strong>
                    </div>
                </div>
            @else
                <div class="ucapan-card p-4 border rounded-3 bg-primary text-white shadow-sm h-100 d-flex flex-column justify-content-center">
                    <h3 class="h5 fw-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    <p class="mb-0 small text-white opacity-75">Status Anda saat ini aktif sebagai peserta sertifikasi.</p>
                    <hr class="border-white opacity-25 my-3">
                    <div class="small">
                        <span class="d-block opacity-75">Skema Diikuti:</span>
                        <strong class="fs-6 text-white">{{ $pesertaAktif->skema->nama_skema ?? '-' }}</strong>
                    </div>
                </div>
            @endif
        </div>


        <div class="col-lg-8">
            <div class="card-box p-4 border rounded-3 bg-white shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h6 fw-bold mb-0 text-dark">Peserta Terbaru</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-app align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Skema</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertaTerbaru as $p)
                                <tr>
                                    <td class="fw-medium">{{ $p->nama }}</td>
                                    <td>{{ $p->nik }}</td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-black px-2 py-1">
                                            {{ $p->skema->nama_skema ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data peserta.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
