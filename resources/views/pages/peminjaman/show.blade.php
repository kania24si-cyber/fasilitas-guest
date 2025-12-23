@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-5">Detail Peminjaman Fasilitas</h2>

    <!-- Detail peminjaman -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h3 class="text-dark font-weight-bold">{{ $item->warga->nama ?? '-' }}</h3>
            <p><strong>Fasilitas:</strong> {{ $item->fasilitas->nama ?? '-' }}</p>
            <p><strong>Tujuan:</strong> {{ $item->tujuan }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</p>
            <p><strong>Total Biaya:</strong> Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <p><strong>Status:</strong>
                @if ($item->status === 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif ($item->status === 'disetujui')
                    <span class="badge bg-primary">Disetujui, silahkan bayar</span>
                @elseif ($item->status === 'lunas')
                    <span class="badge bg-success">Lunas</span>
                @elseif ($item->status === 'ditolak')
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Media peminjaman -->
    <h4 class="mt-4 mb-3">Media Pembayaran dan Dokumen</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($media as $m)
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    @php
                        $filePath = storage_path('app/public/uploads/media/' . $m->file_name);
                        $fileExists = file_exists($filePath);
                        $fileUrl = asset('storage/uploads/media/' . $m->file_name);
                    @endphp

                    {{-- IMAGE --}}
                    @if(Str::startsWith($m->mime_type, 'image'))
                        <img src="{{ $fileExists ? $fileUrl : $placeholderImage }}" class="img-fluid rounded mb-2" style="max-width: 200px;" alt="Media">

                    {{-- PDF --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                        <i class="bi bi-file-earmark-pdf text-danger fs-1 mb-3"></i>

                    {{-- DOCX --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <i class="bi bi-file-earmark-word text-primary fs-1 mb-3"></i>

                    {{-- XLSX --}}
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <i class="bi bi-file-earmark-excel text-success fs-1 mb-3"></i>

                    {{-- DEFAULT --}}
                    @else
                        <img src="{{ $placeholderImage }}" class="img-fluid rounded" style="max-width: 200px;" alt="Tidak Ada Media">
                    @endif

                    <!-- Tombol Hapus dan Download (disusun dengan Flexbox) -->
                    <div class="d-flex justify-content-between mt-2">
                        {{-- Tombol Hapus (Hanya untuk Admin) --}}
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <form action="{{ route('media.fasilitas.delete', $m->media_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 me-2">
                                    <i class="bi bi-trash"></i> Hapus Foto
                                </button>
                            </form>
                        @endif

                        {{-- Tombol Download --}}
                        @if(Str::startsWith($m->mime_type, 'image') || Str::startsWith($m->mime_type, 'application/pdf') || Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                            <a href="{{ $fileUrl }}" class="btn btn-outline-primary btn-sm ms-2 w-100" download>
                                <i class="bi bi-download"></i> Download
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <img src="{{ $placeholderImage }}" class="img-fluid" style="max-width: 200px;" alt="Tidak Ada Media">
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Tombol kembali -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-sm mt-4 px-5 py-2">
                Kembali ke Daftar Peminjaman
            </a>
        </div>
    </div>
</div>
@endsection
