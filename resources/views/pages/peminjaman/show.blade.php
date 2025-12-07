@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Peminjaman Fasilitas</h2>

    <!-- Menampilkan detail peminjaman -->
    <div class="facility-details">
        <h3>{{ $item->warga->nama ?? '-' }}</h3>
        <p><strong>Fasilitas:</strong> {{ $item->fasilitas->nama ?? '-' }}</p>
        <p><strong>Tujuan:</strong> {{ $item->tujuan }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ $item->tanggal_mulai }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $item->tanggal_selesai }}</p>

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

    <h4>Media Pembayaran dan Dokumen</h4>
    <div class="media-list">
        @foreach($media as $m)
            <div class="media-item mb-3">
                @if(Str::startsWith($m->mime_type, 'image'))
                    <img src="{{ asset('uploads/media/'.$m->file_name) }}" width="200" class="m-2" alt="Media">
                @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                    <a href="{{ asset('uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download PDF</a>
                @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                    <a href="{{ asset('uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download DOCX</a>
                @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                    <a href="{{ asset('uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download XLSX</a>
                @else
                    <p>File tidak dikenali</p>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Tombol untuk kembali ke daftar peminjaman -->
    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>
</div>
@endsection
