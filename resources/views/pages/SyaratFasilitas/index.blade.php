@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Syarat Fasilitas</h4>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('syarat_fasilitas.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Syarat Fasilitas
            </a>
        @endif
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari nama syarat..."
                           value="{{ request('search') }}">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            @if(request()->has('search'))
                <div class="col-md-2">
                    <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
            @endif
        </div>
    </form>

    {{-- CARD DISPLAY --}}
    <div class="row">
        @forelse ($syaratFasilitas as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">

                    {{-- Placeholder Logic --}}
                    @php
                        // Check if the media has an image
                        $image = $item->media->first(fn($m) => Str::startsWith($m->mime_type, 'image'));
                        // If image exists, get the file path, otherwise use placeholder image
                        $imagePath = $image ? asset('storage/uploads/media/' . $image->file_name) : $placeholderImage;
                    @endphp

                    <img src="{{ $imagePath }}"
                         class="card-img-top"
                         alt="Syarat Fasilitas"
                         style="height:180px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="text-primary">{{ $item->nama_syarat }}</h5>

                        <p class="mb-1">
                            <strong>Fasilitas:</strong>
                            {{ $item->fasilitas->nama ?? '-' }}
                        </p>

                        <p class="mb-2">
                            <strong>Deskripsi:</strong>
                            {{ Str::limit($item->deskripsi, 60) }}
                        </p>

                        {{-- MEDIA LIST --}}
                        <h6>Dokumen Media:</h6>
                        <div class="media-list mb-3">
                            @if($item->media && $item->media->count())
                                @foreach($item->media as $m)
                                    @php
                                        $fileUrl = asset('storage/uploads/media/' . $m->file_name);
                                    @endphp

                                    @if(Str::startsWith($m->mime_type, 'image'))
                                        <img src="{{ $fileUrl }}" width="80" class="m-1 rounded" alt="Media">
                                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-danger btn-sm mb-1">
                                            PDF
                                        </a>
                                    @elseif(Str::contains($m->mime_type, 'word'))
                                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-primary btn-sm mb-1">
                                            DOCX
                                        </a>
                                    @elseif(Str::contains($m->mime_type, 'sheet'))
                                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-success btn-sm mb-1">
                                            XLSX
                                        </a>
                                    @else
                                        <span class="text-muted d-block">File tidak dikenali</span>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted mb-0">Tidak ada media terkait.</p>
                            @endif
                        </div>

                        {{-- ACTION BUTTON --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('syarat_fasilitas.show', $item->syarat_id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>
                            
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <a href="{{ route('syarat_fasilitas.edit', $item->syarat_id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('syarat_fasilitas.destroy', $item->syarat_id) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>Tidak ada data syarat fasilitas.</p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $syaratFasilitas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
