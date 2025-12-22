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
    <div class="d-flex align-items-center gap-3">

        <!-- Search -->
        <div class="input-group" style="max-width: 250px;"> <!-- Mengatur lebar input pencarian -->
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari tujuan peminjaman..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button> <!-- Menambahkan btn-sm untuk ukuran kecil -->
        </div>

       <!-- Filter Metode with Icon inside -->
        <div style="max-width: 280px; position: relative;"> <!-- Lebarkan dropdown filter menjadi 280px -->
            <select name="metode" class="form-control form-control-sm">
                <option value="">Metode</option>
                @foreach($metodes as $metode)
                    <option value="{{ $metode }}" {{ request('metode') == $metode ? 'selected' : '' }}>{{ $metode }}</option>
                @endforeach
            </select>
            <!-- Icon for select dropdown -->
            <i class="bi bi-chevron-down position-absolute" style="right: 5px; top: 50%; transform: translateY(-50%);"></i> <!-- Menambahkan ikon dropdown di dalam container -->
        </div>


        <!-- Tombol Filter -->
        <button type="submit" class="btn btn-success btn-sm">Filter</button> <!-- Menambahkan btn-sm untuk tombol filter -->

        <!-- Tombol Reset -->
        @if(request()->has('search') || request()->has('metode'))
            <div>
                <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset <!-- Menambahkan ikon reset -->
                </a>
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
                        <p class="mb-2">
                        <strong>Jumlah:</strong>
                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                    </p>
                        <p><b>Metode:</b> {{ $item->metode }}</p>

                        
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
                            @if(auth()->check() && auth()->user()->role !== 'admin' && $item->status === 'lunas')
                                <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-success btn-sm">
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
