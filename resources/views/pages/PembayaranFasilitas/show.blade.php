@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">Detail Pembayaran Fasilitas</h2>

    <!-- Menampilkan detail pembayaran fasilitas -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h3 class="text-dark font-weight-bold">{{ $pembayaran->peminjaman->tujuan }} - {{ $pembayaran->peminjaman->fasilitas->nama }}</h3>
        </div>
        <div class="col-md-6 text-md-end">
            <p class="mb-2"><strong>Tanggal Pembayaran:</strong> {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</p>
            <p class="mb-2"><strong>Jumlah:</strong> Rp {{ number_format($pembayaran->jumlah, 2, ',', '.') }}</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <p><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Keterangan:</strong> {{ $pembayaran->keterangan ?? 'Tidak ada keterangan' }}</p>
        </div>
    </div>

    <!-- Menampilkan media terkait pembayaran fasilitas -->
    <h4 class="mb-4">Resi Pembayaran dan Dokumen Terkait:</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($media as $m)
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    @if(Str::startsWith($m->mime_type, 'image'))
                        @php
                            $imagePath = storage_path('app/public/uploads/media/' . $m->file_name);
                            $fileExists = file_exists($imagePath);
                        @endphp
                        <img src="{{ $fileExists ? asset('storage/uploads/media/'.$m->file_name) : $placeholderImage }}" 
                             class="img-fluid" alt="Resi" style="max-width: 200px;">
                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-danger btn-sm w-100 mt-2">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </a>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-info btn-sm w-100 mt-2">
                            <i class="bi bi-file-earmark-word"></i> Download DOCX
                        </a>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-success btn-sm w-100 mt-2">
                            <i class="bi bi-file-earmark-excel"></i> Download XLSX
                        </a>
                    @else
                        <img src="{{ $placeholderImage }}" class="img-fluid" alt="Tidak Ada Gambar" style="max-width: 200px;">
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tombol untuk kembali ke daftar pembayaran -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar Pembayaran</a>
        </div>
    </div>
</div>
@endsection
