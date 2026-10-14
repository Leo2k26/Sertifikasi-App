@extends('layouts.app') 

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-4 text-center">
                <h3 class="fw-bold mb-2">Halo, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-muted mb-4">Akun Anda berhasil terdaftar. Langkah terakhir, silakan pilih skema sertifikasi Anda untuk memulai.</p>

                <form action="{{ route('dashboard.store-skema') }}" method="POST">
                    @csrf
                    <div class="mb-4 text-start">
                        <label class="form-label fw-medium">Pilih Skema Sertifikasi</label>
                        <select name="skema_id" class="form-select @error('skema_id') is-invalid @enderror" required>
                            <option value="">-- Silakan Pilih --</option>
                            @foreach($skemas as $skema)
                                <option value="{{ $skema->id }}">{{ $skema->nama_skema }}</option>
                            @endforeach
                        </select>
                        @error('skema_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100 py-2 fw-semibold">Ajukan Sertifikasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
