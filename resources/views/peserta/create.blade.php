@extends('layouts.app')
@section('title', 'Tambah Peserta')
@section('page-title', 'Tambah Peserta')
@section('page-subtitle', 'Lengkapi data peserta baru')

@section('content')
    <h1 class="h4 mb-3">Tambah Peserta</h1>
    <div class="card-box">
        <form action="{{ route('peserta.store') }}" method="POST">
            @csrf
            @include('peserta._form', ['peserta' => null])
        </form>
    </div>
@endsection
