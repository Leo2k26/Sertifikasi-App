@extends('layouts.app')
@section('title', 'Detail Peserta')
@section('page-title', 'Detail Peserta')
@section('page-subtitle', 'Informasi lengkap data peserta')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-4 p-md-5">

                    <h3 class="h5 fw-bold text-dark mb-4 pb-2 border-bottom">Informasi Peserta</h3>

                    <div class="vstack gap-3">
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted fw-medium">NIK</span>
                            <span class="fw-semibold text-dark">{{ $peserta->nik }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted fw-medium">Nama Lengkap</span>
                            <span class="fw-semibold text-dark">{{ $peserta->nama }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted fw-medium">Email</span>
                            <span class="fw-semibold text-dark">{{ $peserta->email ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted fw-medium">No. HP</span>
                            <span class="fw-semibold text-dark">{{ $peserta->no_hp ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <span class="text-muted fw-medium">Alamat</span>
                            <span class="fw-semibold text-dark text-end" style="max-width: 60%;">{{ $peserta->alamat ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted fw-medium">Skema Sertifikasi</span>
                            <span class="badge bg-primary-subtle text-primary px-2 py-1 fw-semibold">
                                {{ $peserta->skema->nama_skema ?? '-' }}
                            </span>
                        </div>
                    </div>


                    <div class="mt-4 pt-3 border-top d-flex justify-content-start">
                        <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary px-4">
                            &larr; Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
