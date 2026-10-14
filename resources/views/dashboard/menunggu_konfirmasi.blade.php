@extends('layouts.app') 

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-5 text-center">
                <div class="spinner-border text-warning mb-4" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h3 class="fw-bold mb-2">Pendaftaran Sedang Ditinjau ⏳</h3>
                <p class="text-muted">
                    Anda telah memilih skema: <strong class="text-dark">{{ $pesertaAktif->skema->nama_skema }}</strong>
                </p>
                <div class="alert alert-warning d-inline-block small px-3 py-2 mb-0" role="alert">
                    Mohon tunggu hingga Admin melakukan verifikasi dan menyetujui akun Anda.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
