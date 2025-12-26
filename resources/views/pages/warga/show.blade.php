@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h4>Detail Warga: {{ $warga->nama }}</h4>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <div class="row">
                <!-- Foto Profil Warga -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 120px; height: 120px;">
                        <i class="bi bi-person-fill fs-3"></i>
                    </div>
                </div>

                <!-- Detail Warga -->
                <div class="col-md-9">
                    <h5 class="card-title">{{ $warga->nama }}</h5>
                    <p><strong>No KTP:</strong> {{ $warga->no_ktp }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $warga->jenis_kelamin }}</p>
                    <p><strong>Agama:</strong> {{ $warga->agama ?? 'Tidak Diisi' }}</p>
                    <p><strong>Pekerjaan:</strong> {{ $warga->pekerjaan ?? 'Tidak Diisi' }}</p>
                    <p><strong>Telp:</strong> {{ $warga->telp ?? 'Tidak Diisi' }}</p>
                    <p><strong>Email:</strong> {{ $warga->email }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Kembali ke Index (DI LUAR CARD) --}}
    <div class="mt-3">
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Warga
        </a>
    </div>
</div>
@endsection
