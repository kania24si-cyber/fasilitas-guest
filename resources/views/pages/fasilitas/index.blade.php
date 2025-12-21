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
        <div class="row g-2">
            <div class="col-md-3">
                <select name="jenis" class="form-control">
                    <option value="">-- Filter Jenis --</option>
                    <option value="Ruang Publik" {{ request('jenis')=='Ruang Publik'?'selected':'' }}>Ruang Publik</option>
                    <option value="Olahraga" {{ request('jenis')=='Olahraga'?'selected':'' }}>Olahraga</option>
                    <option value="Kesehatan" {{ request('jenis')=='Kesehatan'?'selected':'' }}>Kesehatan</option>
                    <option value="Pendidikan" {{ request('jenis')=='Pendidikan'?'selected':'' }}>Pendidikan</option>
                </select>
            </div>

            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama / alamat..." value="{{ request('search') }}">
                    <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            @if(request()->has('search') || request()->has('jenis'))
            <div class="col-md-2">
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary w-100">Reset</a>
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
