@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar User</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus"></i> Tambah User
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Pencarian --}}
<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
    </div>
</form>

<div class="row">
    @forelse ($users as $user)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    {{-- Profil & Role --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                             style="width: 50px; height: 50px;">
                            @if($user->profile_picture)
                                <img src="{{ Storage::url($user->profile_picture) }}" class="rounded-circle" alt="Profile Picture" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <i class="bi bi-person fs-4"></i>
                            @endif
                        </div>

                        <div class="ms-3">
                            <h5 class="card-title mb-0">{{ $user->name }}</h5>
                            <small class="text-muted d-block">{{ $user->email }}</small>
                            <span class="badge bg-info text-dark mt-1">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between mt-3">

                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Detail</a>
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
    @empty
        <div class="col-12 text-center text-muted">
            <p>Belum ada pengguna terdaftar.</p>
        </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection
