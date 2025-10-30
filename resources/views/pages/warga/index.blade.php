@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Warga</h4>
        <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus"></i> Tambah Warga
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
        @forelse ($warga as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-person-fill fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                                <small class="text-muted">{{ $item->email }}</small>
                            </div>
                        </div>

                        <p class="mb-1"><strong>No KTP:</strong> {{ $item->no_ktp }}</p>
                        <p class="mb-1"><strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin }}</p>
                        <p class="mb-1"><strong>Agama:</strong> {{ $item->agama }}</p>
                        <p class="mb-1"><strong>Pekerjaan:</strong> {{ $item->pekerjaan }}</p>
                        <p class="mb-1"><strong>Telp:</strong> {{ $item->telp }}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
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
        @empty
            <div class="col-12 text-center text-muted">
                <p>Belum ada data warga.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
