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
            <p class="mb-2"><strong>Jumlah:</strong> Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
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
        @forelse($media as $m)
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
                        <i class="bi bi-file-earmark-pdf text-danger fs-1 mb-3"></i>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                        <i class="bi bi-file-earmark-word text-primary fs-1 mb-3"></i>
                    @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                        <i class="bi bi-file-earmark-excel text-success fs-1 mb-3"></i>
                    @else
                        <img src="{{ $placeholderImage }}" class="img-fluid" alt="Tidak Ada Gambar" style="max-width: 200px;">
                    @endif

                    <!-- Tombol Hapus (Hanya untuk Admin) dan Download (disusun dengan Flexbox) -->
                    <div class="d-flex justify-content-between mt-2">
                        <!-- Tombol Hapus (Hanya untuk Admin) -->
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <form action="{{ route('pembayaran.deleteMedia', $m->media_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm me-2 w-100">
                                    <i class="bi bi-trash"></i> Hapus Foto
                                </button>
                            </form>
                        @endif

                        <!-- Tombol Download -->
                        @if(Str::startsWith($m->mime_type, 'image') || Str::startsWith($m->mime_type, 'application/pdf') || Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                            <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" class="btn btn-outline-primary btn-sm ms-2 w-100" download>
                                <i class="bi bi-download"></i> Download Resi
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
                    <img src="{{ $placeholderImage }}" class="img-fluid" alt="Tidak Ada Gambar" style="max-width: 200px;">
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Tombol untuk kembali ke daftar pembayaran -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar Pembayaran</a>
        </div>
    </div>
</div>
@endsection
