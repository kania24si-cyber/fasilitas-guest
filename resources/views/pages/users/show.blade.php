@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail User</h4>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar User
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus pengguna ini?')" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
