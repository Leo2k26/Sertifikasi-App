@extends('layouts.app')
@section('title', 'Data Skema')
@section('page-title', 'Data Skema Sertifikasi')
@section('page-subtitle', 'Kelola daftar skema sertifikasi')

@section('content')
<h1 class="h4 mb-3">Tambah Skema Sertifikasi</h1>
<div class="card-box">
    <form action="{{ route('skema.store') }}" method="POST">
        @csrf
        @include('skema._form', ['skema' => null])
    </form>
</div>
@endsection
