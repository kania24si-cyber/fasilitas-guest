@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Fasilitas Umum</h4>
        @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Fasilitas
        </a>
        @endif
    </div>

   {{-- FILTER & SEARCH --}}
<form method="GET" class="mb-4">
    <div class="d-flex align-items-center gap-3">
        
        <!-- Pencarian -->
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / alamat..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <!-- Filter Jenis -->
        <div style="max-width: 220px; position: relative;">
            <select name="jenis" class="form-control form-control-sm">
                <option value="">Jenis</option>
                <option value="Ruang Publik" {{ request('jenis')=='Ruang Publik'?'selected':'' }}>Ruang Publik</option>
                <option value="Olahraga" {{ request('jenis')=='Olahraga'?'selected':'' }}>Olahraga</option>
                <option value="Kesehatan" {{ request('jenis')=='Kesehatan'?'selected':'' }}>Kesehatan</option>
                <option value="Pendidikan" {{ request('jenis')=='Pendidikan'?'selected':'' }}>Pendidikan</option>
            </select>
            <!-- Icon for select dropdown -->
            <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
        </div>

        <!-- Tombol Filter -->
        <button type="submit" class="btn btn-success btn-sm">
            <i class="bi bi-funnel"></i> Filter
        </button>


        <!-- Tombol Reset -->
        @if(request()->has('search') || request()->has('jenis'))
            <div>
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        @endif
    </div>
</form>

    @php
    $placeholderImage = asset('assets/img/placeholder.jpg');  // Placeholder image
    @endphp

    <div class="row">
        @forelse ($data as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">

                {{-- FOTO / PLACEHOLDER --}}
                <div class="row mb-3">
                    @php
                        // Check if the media has an image
                        $image = $item->media->first(fn($m) => Str::startsWith($m->mime_type, 'image'));
                        // If image exists, get the file path, otherwise use placeholder image
                        $imagePath = $image ? asset('storage/uploads/media/' . $image->file_name) : $placeholderImage;
                    @endphp
                    <div class="col-12">
                        <!-- Menampilkan foto penuh -->
                        <img src="{{ $imagePath }}"
                             class="img-fluid rounded mb-3"
                             style="width: 100%; height: 180px; object-fit: cover;"
                             alt="Foto Fasilitas">
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="text-primary">{{ $item->nama }}</h5>
                    <p><b>Jenis:</b> {{ $item->jenis }}</p>
                    <p><b>Alamat:</b> {{ $item->alamat }} (RT {{ $item->rt }}/RW {{ $item->rw }})</p>
                    <p><b>Kapasitas:</b> {{ $item->kapasitas ?? '-' }}</p>
                    <p><b>Deskripsi:</b> {{ Str::limit($item->deskripsi, 60) }}</p>

                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('fasilitas.show', $item->fasilitas_id) }}" class="btn btn-info btn-sm">Detail</a>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}">
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

    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
