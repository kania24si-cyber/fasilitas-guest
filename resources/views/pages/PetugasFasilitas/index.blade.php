@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Petugas Fasilitas</h4>
        @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Petugas
        </a>
        @endif
    </div>

  {{-- FILTER & SEARCH --}}
<form method="GET" class="mb-4">
    <div class="d-flex align-items-center gap-3">

        {{-- SEARCH --}}
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama petugas..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button> <!-- Tombol pencarian dengan ikon -->
        </div>

        {{-- FILTER FASILITAS WITH ICON IN CONTAINER --}}
        <div style="max-width: 220px; position: relative;" class="d-flex align-items-center">
            <select name="fasilitas" class="form-control form-control-sm">
                <option value="">Fasilitas</option>
                @foreach($fasilitas as $f)
                    <option value="{{ $f->id }}" {{ request('fasilitas') == $f->id ? 'selected' : '' }}>{{ $f->nama }}</option>
                @endforeach
            </select>
            <!-- Icon inside the select container -->
            <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i> <!-- Ikon berada di dalam container dropdown -->
        </div>

        {{-- BUTTON FILTER --}}
        <button type="submit" class="btn btn-success btn-sm">Filter</button> <!-- Tombol filter di sebelah filter -->

        {{-- BUTTON RESET --}}
        @if(request()->has('search') || request()->has('fasilitas'))
            <div>
                <a href="{{ route('petugas.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        @endif
    </div>
</form>



    {{-- Card Display --}}
    <div class="row">
        @forelse ($petugas as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        {{-- Informasi Petugas --}}
                        <h5 class="text-primary">{{ $item->petugas_warga->nama }}</h5>

                        {{-- Fasilitas dan Peran --}}
                        <p><strong>Fasilitas:</strong> {{ $item->fasilitas->nama }}</p>
                        <p><strong>Peran:</strong> {{ $item->peran }}</p>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <!-- Tombol Edit -->
                                <a href="{{ route('petugas.edit', $item->petugas_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Tombol Hapus -->
                                <form method="POST" action="{{ route('petugas.destroy', $item->petugas_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Tidak ada data</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $petugas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
