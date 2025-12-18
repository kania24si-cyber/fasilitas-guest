@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-5">Detail Peminjaman Fasilitas</h2>

    <!-- Menampilkan detail peminjaman -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h3 class="text-dark font-weight-bold">{{ $item->warga->nama ?? '-' }}</h3>
            <p><strong>Fasilitas:</strong> {{ $item->fasilitas->nama ?? '-' }}</p>
            <p><strong>Tujuan:</strong> {{ $item->tujuan }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</p>
            <p><strong>Total Biaya:</strong> Rp {{ number_format($item->total_biaya, 2, ',', '.') }}</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <p><strong>Status:</strong>
                @if ($item->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif ($item->status == 'disetujui')
                    <span class="badge bg-success">Disetujui</span>
                @elseif ($item->status == 'ditolak')
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Menampilkan media terkait peminjaman -->
    <h4 class="mt-4 mb-3">Media Pembayaran dan Dokumen</h4>
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
                             class="img-fluid rounded m-2" alt="Media" style="max-width: 200px;">
                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-danger btn-sm w-100 mt-3">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </a>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-info btn-sm w-100 mt-3">
                            <i class="bi bi-file-earmark-word"></i> Download DOCX
                        </a>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-outline-success btn-sm w-100 mt-3">
                            <i class="bi bi-file-earmark-excel"></i> Download XLSX
                        </a>
                    @else
                        <img src="{{ $placeholderImage }}" class="img-fluid m-2" alt="Media" style="max-width: 200px;">
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tombol untuk kembali ke daftar peminjaman -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-sm mt-4 px-5 py-2">Kembali ke Daftar Peminjaman</a>
        </div>
    </div>
</div>
@endsection
