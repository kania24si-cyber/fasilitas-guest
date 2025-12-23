@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Peminjaman Fasilitas</h4>
        @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Peminjaman
        </a>
        @endif
    </div>

{{-- FILTER & SEARCH --}}
<form method="GET" class="mb-4">
    <div class="d-flex align-items-center gap-3">

        {{-- FILTER STATUS --}}
        <div class="position-relative" style="max-width: 220px;">
            <select name="status" class="form-control form-control-sm">
                <option value="">Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                <option value="lunas" {{ request('status')=='lunas'?'selected':'' }}>Lunas</option>
                <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
            </select>
            <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
        </div>

        {{-- FILTER WARGA --}}
        <div class="position-relative" style="max-width: 220px;">
            <select name="warga_id" class="form-control form-control-sm">
                <option value="">Warga</option>
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}" {{ request('warga_id')==$w->warga_id?'selected':'' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
        </div>

        {{-- FILTER FASILITAS --}}
        <div class="position-relative" style="max-width: 220px;">
            <select name="fasilitas_id" class="form-control form-control-sm">
                <option value="">Fasilitas</option>
                @foreach($fasilitas as $f)
                    <option value="{{ $f->fasilitas_id }}" {{ request('fasilitas_id')==$f->fasilitas_id?'selected':'' }}>
                        {{ $f->nama }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
        </div>

        {{-- SEARCH --}}
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari tujuan..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
            </button>
        </div>

        {{-- BUTTON FILTER --}}
        <button type="submit" class="btn btn-success btn-sm">Filter</button>

        {{-- BUTTON RESET --}}
        @if(request()->has('search') || request()->has('status') || request()->has('warga_id') || request()->has('fasilitas_id'))
            <div>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        @endif
    </div>
</form>



    <div class="row">
        @forelse ($data as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">

                        <h5 class="card-title text-primary mb-2">
                            {{ $item->warga->nama ?? '-' }}
                        </h5>

                        <p class="mb-1"><strong>Fasilitas:</strong> {{ $item->fasilitas->nama ?? '-' }}</p>
                        <p class="mb-1"><strong>Tujuan:</strong> {{ $item->tujuan }}</p>
                        <p class="mb-1"><strong>Tanggal Mulai:</strong> {{ $item->tanggal_mulai }}</p>
                        <p class="mb-1"><strong>Tanggal Selesai:</strong> {{ $item->tanggal_selesai }}</p>

                        <p class="mb-2">
                            <strong>Status:</strong>
                            @if ($item->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($item->status === 'disetujui')
                                <span class="badge bg-primary">Disetujui, silahkan bayar</span>
                            @elseif ($item->status === 'lunas')
                                <span class="badge bg-success">Lunas</span>
                            @elseif ($item->status === 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </p>

                        <p class="mb-2">
                            <strong>Total Biaya:</strong>
                            Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                        </p>

                        {{-- TOMBOL KIRIM BUKTI PEMBAYARAN (USER) --}}
                        @if(auth()->check() && auth()->user()->role !== 'admin' && $item->status === 'disetujui')
                            <div class="mt-3">
                                <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}"
                                   class="btn btn-primary btn-sm w-100">
                                    <i class="bi bi-upload"></i> Kirim Bukti Pembayaran
                                </a>
                            </div>
                        @endif

                        {{-- TOMBOL ADMIN --}}
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <a href="{{ route('peminjaman.show', $item->pinjam_id) }}"
                               class="btn btn-info btn-sm">
                         Detail
                            </a>

                            <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}"
                               class="btn btn-outline-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>

                        </div>
                        @endif

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
