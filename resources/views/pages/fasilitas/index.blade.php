@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Fasilitas Umum</h4>
        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Fasilitas
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        @forelse ($data as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-0">

                    @if ($item->media)
                        <img src="{{ asset('storage/' . $item->media) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-primary mb-2">{{ $item->nama }}</h5>

                        <p class="mb-1"><strong>Jenis:</strong> {{ $item->jenis }}</p>
                        <p class="mb-1"><strong>Alamat:</strong> {{ $item->alamat }} RT {{ $item->rt }}/RW {{ $item->rw }}</p>
                        <p class="mb-1"><strong>Kapasitas:</strong> {{ $item->kapasitas ?? '-' }}</p>

                        <p class="mb-2">
                            <strong>Deskripsi:</strong> 
                            {{ Str::limit($item->deskripsi, 60) }}
                        </p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus fasilitas ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @empty
            <div class="col-12 text-center text-muted">
                <p>Belum ada fasilitas umum</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
