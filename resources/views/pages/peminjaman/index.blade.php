@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Peminjaman Fasilitas</h4>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Peminjaman
        </a>
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">

            {{-- FILTER STATUS --}}
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Filter Status --</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>

            {{-- FILTER WARGA --}}
            <div class="col-md-3">
                <select name="warga_id" class="form-control">
                    <option value="">-- Filter Warga --</option>
                    @foreach($warga as $w)
                        <option value="{{ $w->warga_id }}" {{ request('warga_id')==$w->warga_id?'selected':'' }}>
                            {{ $w->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- FILTER FASILITAS --}}
            <div class="col-md-3">
                <select name="fasilitas_id" class="form-control">
                    <option value="">-- Filter Fasilitas --</option>
                    @foreach($fasilitas as $f)
                        <option value="{{ $f->fasilitas_id }}" {{ request('fasilitas_id')==$f->fasilitas_id?'selected':'' }}>
                            {{ $f->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SEARCH --}}
            <div class="col-md-3">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari tujuan..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            {{-- BUTTON FILTER --}}
            <div class="col-md-2 mt-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            {{-- BUTTON RESET --}}
            @if(request()->has('search') || request()->has('status') || request()->has('warga_id') || request()->has('fasilitas_id'))
            <div class="col-md-2 mt-2">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
            @endif
        </div>
    </form>

    <div class="row">
        @forelse ($data as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-2">{{ $item->warga->nama ?? '-' }}</h5>

                        <p class="mb-1"><strong>Fasilitas:</strong> {{ $item->fasilitas->nama ?? '-' }}</p>
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
                            @endif
                        </p>

                        <!-- Tombol Detail, Edit, Hapus diatur supaya rapi -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('peminjaman.show', $item->pinjam_id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>

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

    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
