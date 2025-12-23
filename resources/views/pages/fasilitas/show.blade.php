@extends('layouts.guest.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary font-weight-bold">Detail Fasilitas Umum</h2>

    <!-- Detail fasilitas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="font-weight-bold">{{ $item->nama }}</h3>
            <p><strong>Jenis:</strong> {{ $item->jenis }}</p>
            <p><strong>Alamat:</strong> {{ $item->alamat }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>RT/RW:</strong> {{ $item->rt }}/{{ $item->rw }}</p>
            <p><strong>Kapasitas:</strong> {{ $item->kapasitas }}</p>
            <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
        </div>
    </div>

    <!-- Media fasilitas -->
    <h4 class="mt-5 mb-4 text-muted">Foto / SOP Media</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($media as $m)
        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">

                    @php
                        $filePath = storage_path('app/public/uploads/media/' . $m->file_name);
                        $fileExists = file_exists($filePath);
                        $fileUrl = asset('storage/uploads/media/' . $m->file_name);
                    @endphp

                    {{-- IMAGE --}}
                    @if(Str::startsWith($m->mime_type, 'image'))
                        <img src="{{ $fileExists ? $fileUrl : $placeholderImage }}"
                             class="img-fluid rounded mb-3"
                             style="max-height: 200px; object-fit: cover;"
                             alt="Media Fasilitas">

                    {{-- PDF --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                        <i class="bi bi-file-earmark-pdf text-danger fs-1 mb-3"></i>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-danger btn-sm w-100 mt-2" download>
                            <i class="bi bi-download"></i> Download PDF
                        </a>

                    {{-- DOCX --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <i class="bi bi-file-earmark-word text-primary fs-1 mb-3"></i>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-primary btn-sm w-100 mt-2" download>
                            <i class="bi bi-download"></i> Download DOCX
                        </a>

                    {{-- XLSX --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <i class="bi bi-file-earmark-excel text-success fs-1 mb-3"></i>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-success btn-sm w-100 mt-2" download>
                            <i class="bi bi-download"></i> Download XLSX
                        </a>

                    {{-- DEFAULT / placeholder --}}
                    @else
                        <img src="{{ $placeholderImage }} "
                             class="img-fluid rounded"
                             style="max-height: 200px;"
                             alt="Tidak Ada Media">
                    @endif

                    <div class="d-flex justify-content-between mt-3">
                        {{-- Tombol Hapus Foto (Admin) --}}
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <form action="{{ route('media.fasilitas.delete', $m->media_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus Foto
                            </button>
                        </form>
                        @endif

                        {{-- Tombol Download (Hanya untuk file yang bisa diunduh) --}}
                        @if(Str::startsWith($m->mime_type, 'image') || Str::startsWith($m->mime_type, 'application/pdf') || Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <a href="{{ $fileUrl }}" class="btn btn-outline-primary btn-sm" download>
                            <i class="bi bi-download"></i> Download
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @empty
        {{-- Jika tidak ada media sama sekali --}}
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <img src="{{ $placeholderImage }} "
                         class="img-fluid rounded"
                         style="max-height: 200px;"
                         alt="Tidak Ada Media">
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Tombol kembali -->
    <div class="mt-4 text-center">
        <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Fasilitas
        </a>
    </div>
</div>
@endsection
