@extends('layouts.guest.app')

@section('content')
<div class="container mt-5">
    <!-- Title and Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary font-weight-bold">Detail Syarat Fasilitas</h2>
        <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Syarat Fasilitas
        </a>
    </div>

    <!-- Syarat Details Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3 font-weight-bold">{{ $syarat->nama_syarat }}</h3>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Fasilitas:</strong> {{ $syarat->fasilitas->nama }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Deskripsi:</strong> {{ $syarat->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dokumen Terkait -->
    <h4 class="mt-5 mb-3 text-muted">Dokumen Terkait:</h4>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($media as $m)
        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">

                    @php
                        // Path to check if file exists
                        $filePath = storage_path('app/public/uploads/media/' . $m->file_name);
                        $fileExists = file_exists($filePath);
                        $fileUrl = asset('storage/uploads/media/' . $m->file_name);
                    @endphp

                    {{-- IMAGE --}}
                    @if(Str::startsWith($m->mime_type, 'image'))
                        <img src="{{ $fileExists ? $fileUrl : $placeholderImage }}"
                             class="img-fluid rounded mb-2"
                             alt="Dokumen"
                             style="max-width: 200px;">

                        @if($fileExists)
                            <a href="{{ $fileUrl }}" class="btn btn-outline-primary btn-sm w-100 mt-2" download>
                                <i class="bi bi-download"></i> Download Gambar
                            </a>
                        @endif

                    {{-- PDF --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                        <i class="bi bi-file-earmark-pdf text-danger fs-1 mb-3"></i>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-danger btn-sm w-100 mt-3" download>
                            <i class="bi bi-download"></i> Download PDF
                        </a>

                    {{-- DOCX --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <i class="bi bi-file-earmark-word text-primary fs-1 mb-3"></i>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-info btn-sm w-100 mt-3" download>
                            <i class="bi bi-download"></i> Download DOCX
                        </a>

                    {{-- XLSX --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <i class="bi bi-file-earmark-excel text-success fs-1 mb-3"></i>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-success btn-sm w-100 mt-3" download>
                            <i class="bi bi-download"></i> Download XLSX
                        </a>

                    {{-- DEFAULT / NO FILE --}}
                    @else
                        <!-- If no image or file, show the placeholder -->
                        <img src="{{ $placeholderImage }}" class="img-fluid" alt="Tidak Ada Gambar" style="max-width: 200px;">
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <img src="{{ $placeholderImage }}" class="img-fluid" alt="Tidak Ada Gambar" style="max-width: 200px;">
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
