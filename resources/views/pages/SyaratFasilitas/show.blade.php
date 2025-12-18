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
        @foreach($media as $m)
        <div class="col mb-4">
            @if(Str::startsWith($m->mime_type, 'image'))
                <!-- Cek apakah file gambar ada di server -->
                @php
                    $imagePath = storage_path('app/public/uploads/media/' . $m->file_name);
                    $fileExists = file_exists($imagePath);
                @endphp

                <div class="card shadow-sm rounded-lg">
                    <img src="{{ $fileExists ? asset('storage/uploads/media/'.$m->file_name) : $placeholderImage }}" 
                         class="card-img-top" alt="Media" style="max-height: 200px; object-fit: cover;">
                </div>
            @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body text-center">
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-danger w-100">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>
            @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body text-center">
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-warning w-100">
                            <i class="bi bi-file-earmark-word"></i> Download DOCX
                        </a>
                    </div>
                </div>
            @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body text-center">
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-success w-100">
                            <i class="bi bi-file-earmark-excel"></i> Download XLSX
                        </a>
                    </div>
                </div>
            @else
                <!-- Menampilkan gambar placeholder jika tidak ada gambar -->
                <img src="{{ $placeholderImage }}" width="200" class="m-2 rounded" alt="Tidak Ada Gambar">
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
