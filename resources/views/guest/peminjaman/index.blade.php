@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Peminjaman</h4>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Peminjaman
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
        @forelse ($peminjaman as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-2">
                            {{ $item->warga->nama ?? 'Tidak diketahui' }}
                        </h5>
                        <p class="mb-1"><strong>Tujuan:</strong> {{ $item->tujuan }}</p>
                        <p class="mb-1"><strong>Tanggal Mulai:</strong> {{ $item->tanggal_mulai }}</p>
                        <p class="mb-1"><strong>Tanggal Selesai:</strong> {{ $item->tanggal_selesai }}</p>
                        <p class="mb-2">
                            <strong>Status:</strong>
                            @if ($item->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($item->status == 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif ($item->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}" method="POST" class="d-inline">
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
                <p>Belum ada data peminjaman.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
