@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail Warga: {{ $warga->nama }}</h4>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Warga
        </a>
    </div>

    <div class="card shadow-sm">
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

            <div class="d-flex justify-content-between mt-3">
                <!-- Tombol Edit -->
                <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>

                <!-- Tombol Hapus -->
                <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
