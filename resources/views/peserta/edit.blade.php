@extends('layouts.app')
@section('title', 'Edit Peserta')
@section('page-title', 'Edit Peserta')
@section('page-subtitle', 'Kelola data peserta sertifikasi')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-4 p-md-5">

                    <h3 class="h5 fw-bold text-dark mb-4 pb-2 border-bottom">Form Ubah Data Peserta</h3>

                    <form action="{{ route('peserta.update', $peserta) }}" method="POST">
                        @csrf
                        @method('PUT')


                        @include('peserta._form')


                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
