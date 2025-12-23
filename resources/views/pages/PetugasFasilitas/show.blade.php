@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-primary">Detail Petugas Fasilitas</h4>
        <a href="{{ route('petugas.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Petugas
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">
            {{-- Informasi Petugas --}}
            <h5 class="text-primary font-weight-bold mb-3">{{ $petugas->petugas_warga->nama }}</h5>

            {{-- Fasilitas dan Peran --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Fasilitas:</strong> {{ $petugas->fasilitas->nama }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Peran:</strong> {{ $petugas->peran }}</p>
                </div>
            </div>

            {{-- Informasi Tambahan --}}
            <div>
                <h6 class="text-muted mb-2">Detail Informasi:</h6>
                <ul class="list-unstyled">
                    <li><strong>Nama Petugas:</strong> {{ $petugas->petugas_warga->nama }}</li>
                    <li><strong>Fasilitas:</strong> {{ $petugas->fasilitas->nama }}</li>
                    <li><strong>Peran:</strong> {{ $petugas->peran }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
