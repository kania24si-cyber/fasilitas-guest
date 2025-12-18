@extends('layouts.guest.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary font-weight-bold">Detail Fasilitas Umum</h2>

    <!-- Menampilkan data fasilitas menggunakan grid bootstrap -->
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

    <!-- Menampilkan media terkait fasilitas -->
    <h4 class="mt-5 mb-4 text-muted">Foto / SOP Media</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($media as $m)
        <div class="col mb-4">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body">
                    @if(Str::startsWith($m->mime_type, 'image'))
                        <!-- Cek jika file gambar ada, atau tampilkan placeholder jika tidak ada -->
                        @php
                            $imagePath = storage_path('app/public/uploads/media/' . $m->file_name);
                            $fileExists = file_exists($imagePath);
                        @endphp
                        <img src="{{ $fileExists ? asset('storage/uploads/media/'.$m->file_name) : $placeholderImage }}" 
                             class="img-fluid rounded border border-light shadow-sm m-2" alt="Media">
                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                        <!-- Tombol Download PDF -->
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100 mt-2">Download PDF</a>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <!-- Tombol Download DOCX -->
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100 mt-2">Download DOCX</a>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <!-- Tombol Download XLSX -->
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100 mt-2">Download XLSX</a>
                    @else
                        <!-- Jika tipe file lainnya, tampilkan gambar placeholder -->
                        <img src="{{ $placeholderImage }}" class="img-fluid rounded border border-light shadow-sm m-2" alt="Tidak Ada Gambar">
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-secondary btn-sm px-4 py-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Fasilitas
        </a>
    </div>
</div>
@endsection
