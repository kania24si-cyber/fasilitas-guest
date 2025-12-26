@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Pembayaran Fasilitas</h4>
         @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('pembayaran_fasilitas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Pembayaran
        </a>
        @endif
    </div>


{{-- FILTER & SEARCH --}}
<form method="GET" class="mb-4">
    <div class="d-flex align-items-center gap-3 flex-wrap">

        {{-- SEARCH: tujuan peminjaman / nama warga --}}
        <div class="input-group input-group-sm" style="max-width: 260px;">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari tujuan / nama warga..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
        </div>

        {{-- FILTER METODE --}}
        <div style="max-width: 220px; position: relative;">
            <select name="metode" class="form-control form-control-sm">
                <option value="">Metode</option>
                @foreach($metodes as $metode)
                    <option
                        value="{{ $metode }}"
                        {{ request('metode') === $metode ? 'selected' : '' }}
                    >
                        {{ $metode }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-chevron-down position-absolute end-0 top-50 translate-middle-y me-2"></i>
        </div>

        {{-- TOMBOL FILTER --}}
        <button type="submit" class="btn btn-success btn-sm">
            <i class="bi bi-funnel"></i> Filter
        </button>

        {{-- TOMBOL RESET --}}
        @if(request()->hasAny(['search','metode']))
            <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </a>
        @endif

    </div>
</form>




    {{-- Card Display --}}
    <div class="row">
        @foreach ($data as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="text-primary">{{ $item->peminjaman->tujuan }}</h5>

                        <p><strong>Nama Warga:</strong> {{ $item->peminjaman->warga->nama ?? '-' }}</p>
                        <p><strong>Tanggal:</strong> {{ $item->tanggal }}</p>
                        <p><strong>Jumlah:</strong> Rp {{ number_format($item->jumlah,0,',','.') }}</p>
                        <p><strong>Metode:</strong> {{ $item->metode }}</p>


                        
                        <div class="d-flex justify-content-between">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                            <!-- Tombol Detail -->
                            <a href="{{ route('pembayaran_fasilitas.show', $item->bayar_id) }}" class="btn btn-info btn-sm">Detail</a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('pembayaran_fasilitas.edit', $item->bayar_id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Tombol Hapus -->
                            <form method="POST" action="{{ route('pembayaran_fasilitas.destroy', $item->bayar_id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            @endif

                            {{-- Conditionally Display View Resi Button --}}
                           @if(
                            auth()->check() &&
                            auth()->user()->role !== 'admin' &&
                            optional($item->peminjaman)->status &&
                            strtolower($item->peminjaman->status) === 'lunas'
                        )

                            <a href="{{ route('pembayaran_fasilitas.show', $item->bayar_id) }}"
                            class="btn btn-success btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Lihat Resi
                            </a>
                        @endif


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Paginasi --}}
    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
