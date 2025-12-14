@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Petugas Fasilitas</h4>
        <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Petugas
        </a>
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="fasilitas" class="form-control">
                    <option value="">-- Filter Fasilitas --</option>
                    @foreach($fasilitas as $f)
                        <option value="{{ $f->id }}" {{ request('fasilitas') == $f->id ? 'selected' : '' }}>{{ $f->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama petugas..." value="{{ request('search') }}">
                    <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            @if(request()->has('search') || request()->has('fasilitas'))
            <div class="col-md-2">
                <a href="{{ route('petugas.index') }}" class="btn btn-secondary w-100">Reset</a>
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
                        <h5 class="text-primary">{{ $item->petugas_warga->nama }}</h5>

                        <p><b>Fasilitas:</b> {{ $item->fasilitas->nama }}</p>
                        <p><b>Peran:</b> {{ $item->peran }}</p>

                        <div class="d-flex justify-content-between">
                            <!-- Tombol Edit -->
                            <a href="{{ route('petugas.edit', $item->petugas_id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Tombol Hapus -->
                            <form method="POST" action="{{ route('petugas.destroy', $item->petugas_id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Tidak ada data</p>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $petugas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
