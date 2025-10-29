@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar User</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus"></i> Tambah User
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        @forelse ($users as $i => $user)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title mb-0">{{ $user->name }}</h5>
                                <small class="text-muted">{{ $user->email }}</small>
                            </div>
                        </div>

                        <p class="mb-1"><strong>Password (Hashed):</strong></p>
                        <p><code class="text-break">{{ $user->password }}</code></p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus user ini?')" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>Belum ada user terdaftar.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
