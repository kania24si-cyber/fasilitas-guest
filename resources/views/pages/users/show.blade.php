@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card Detail User --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row mb-4">
                {{-- Foto Profil --}}
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                         style="width: 100px; height: 100px;">
                        @if($user->profile_picture)
                            <img src="{{ Storage::url($user->profile_picture) }}" class="rounded-circle" alt="Profile Picture" style="width: 90px; height: 90px; object-fit: cover;">
                        @else
                            <i class="bi bi-person fs-3"></i>
                        @endif
                    </div>
                </div>

                {{-- Informasi User --}}
                <div class="col-md-9">
                    <h4 class="card-title mb-0">{{ $user->name }}</h4>
                    <small class="text-muted d-block">{{ $user->email }}</small>
                    <span class="badge bg-info text-dark mt-2">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>

            {{-- Detail Informasi User --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Detail Informasi:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Nama:</strong> {{ $user->name }}</li>
                        <li><strong>Email:</strong> {{ $user->email }}</li>
                        <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Foto Profil:</h5>
                    @if($user->profile_picture)
                        <img src="{{ Storage::url($user->profile_picture) }}" class="rounded" style="width: 100px;">
                    @else
                        <span>Tidak ada foto profil.</span>
                    @endif
                </div>
            </div>

            {{-- Hapus Tombol Aksi Edit & Hapus --}}
            {{-- Tidak ada tombol aksi di sini --}}

        </div>
    </div>

    {{-- Tombol Kembali ke Index (BAWAH) --}}
    <div class="mt-3">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar User
        </a>
    </div>

</div>
@endsection
