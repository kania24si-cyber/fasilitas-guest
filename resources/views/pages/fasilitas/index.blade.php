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
        
        <!-- Search -->
        <div class="input-group" style="max-width: 250px;"> <!-- Mengatur lebar input pencarian -->
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / alamat..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i> <!-- Menambahkan ikon pencarian -->
            </button>
        </div>

        <!-- Filter Jenis with Icon -->
        <div style="max-width: 220px; position: relative;">
            <select name="jenis" class="form-control form-control-sm">
                <option value="">Jenis</option>
                <option value="Ruang Publik" {{ request('jenis')=='Ruang Publik'?'selected':'' }}>Ruang Publik</option>
                <option value="Olahraga" {{ request('jenis')=='Olahraga'?'selected':'' }}>Olahraga</option>
                <option value="Kesehatan" {{ request('jenis')=='Kesehatan'?'selected':'' }}>Kesehatan</option>
                <option value="Pendidikan" {{ request('jenis')=='Pendidikan'?'selected':'' }}>Pendidikan</option>
            </select>
            <!-- Icon for select dropdown -->
            <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i> <!-- Menambahkan ikon dropdown -->
        </div>

        <!-- Tombol Filter -->
        <button type="submit" class="btn btn-success btn-sm">Filter</button> <!-- Menambahkan btn-sm untuk tombol filter -->

        <!-- Tombol Reset -->
        @if(request()->has('search') || request()->has('jenis'))
            <div>
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset <!-- Menambahkan ikon reset -->
                </a>
            </div>
        @endif
    </div>
</form>





    @php
    $placeholderImage = asset('assets/img/placeholder.jpg');
    @endphp

    <div class="row">
        @forelse ($data as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">

                {{-- FOTO / PLACEHOLDER --}}
                @php
                    // Check if there's an image in the media
                    $image = $item->media->where('mime_type', 'like', 'image%')->first();
                    // If no image, use the placeholder
                    $imageUrl = $image ? asset('storage/uploads/media/' . $image->file_name) : $placeholderImage;
                @endphp

                <img src="{{ $imageUrl }}"
                     class="card-img-top"
                     alt="Foto Fasilitas"
                     style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="text-primary">{{ $item->nama }}</h5>
                    <p><b>Jenis:</b> {{ $item->jenis }}</p>
                    <p><b>Alamat:</b> {{ $item->alamat }} (RT {{ $item->rt }}/RW {{ $item->rw }})</p>
                    <p><b>Kapasitas:</b> {{ $item->kapasitas ?? '-' }}</p>
                    <p><b>Deskripsi:</b> {{ Str::limit($item->deskripsi, 60) }}</p>

                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('fasilitas.show', $item->fasilitas_id) }}" class="btn btn-info btn-sm">Detail</a>

                        {{-- Media List with download buttons --}}
                        @foreach($item->media as $media)
                            @php
                                $fileUrl = asset('storage/uploads/media/' . $media->file_name);
                            @endphp

                            @if(Str::startsWith($media->mime_type, 'application/pdf'))
                                <a href="{{ $fileUrl }}" target="_blank" class="btn btn-danger btn-sm mb-1">
                                    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                                </a>
                            @elseif(Str::contains($media->mime_type, 'word'))
                                <a href="{{ $fileUrl }}" target="_blank" class="btn btn-primary btn-sm mb-1">
                                    <i class="bi bi-file-earmark-word"></i> Download DOCX
                                </a>
                            @elseif(Str::contains($media->mime_type, 'sheet'))
                                <a href="{{ $fileUrl }}" target="_blank" class="btn btn-success btn-sm mb-1">
                                    <i class="bi bi-file-earmark-excel"></i> Download XLSX
                                </a>
                            @else
                                <a href="{{ $fileUrl }}" class="btn btn-outline-primary btn-sm mb-1">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            @endif
                        @endforeach

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
