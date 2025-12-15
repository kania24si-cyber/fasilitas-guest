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
        <div class="row g-2">
            <div class="col-md-3">
                <select name="metode" class="form-control">
                    <option value="">-- Filter Metode --</option>
                    @foreach($metodes as $metode)
                        <option value="{{ $metode }}" {{ request('metode') == $metode ? 'selected' : '' }}>{{ $metode }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari tujuan peminjaman..." value="{{ request('search') }}">
                    <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            @if(request()->has('search') || request()->has('metode'))
            <div class="col-md-2">
                <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
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

                        <p><b>Tanggal Pembayaran:</b> {{ $item->tanggal }}</p>
                        <p><b>Jumlah:</b> {{ number_format($item->jumlah, 2) }}</p>
                        <p><b>Metode:</b> {{ $item->metode }}</p>

                        <div class="d-flex justify-content-between">
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
