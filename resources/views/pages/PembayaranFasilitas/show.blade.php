// resources/views/pages/pembayaran_fasilitas/show.blade.php
@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Pembayaran Fasilitas</h2>

    <!-- Menampilkan detail pembayaran fasilitas -->
    <div class="payment-details">
        <h3>{{ $pembayaran->peminjaman->tujuan }} - {{ $pembayaran->peminjaman->fasilitas->nama }}</h3>
        <p><strong>Tanggal Pembayaran:</strong> {{ $pembayaran->tanggal }}</p>
        <p><strong>Jumlah:</strong> {{ number_format($pembayaran->jumlah, 2) }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode }}</p>
        <p><strong>Keterangan:</strong> {{ $pembayaran->keterangan ?? 'Tidak ada keterangan' }}</p>
    </div>

    <!-- Menampilkan media terkait pembayaran fasilitas -->
    <h4>Resi Pembayaran dan Dokumen Terkait:</h4>
    <div class="media-list">
        @foreach($media as $m)
            @if(Str::startsWith($m->mime_type, 'image'))
                <!-- Menampilkan gambar -->
                <img src="{{ asset('storage/uploads/media/'.$m->file_name) }}" width="200" class="m-2" alt="Resi">
            @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                <!-- Tombol Download PDF -->
                <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download PDF</a>
            @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                <!-- Tombol Download DOCX -->
                <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download DOCX</a>
            @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                <!-- Tombol Download XLSX -->
                <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download XLSX</a>
            @else
                <p>File tidak dikenali</p>
            @endif
        @endforeach
    </div>

    <!-- Tombol untuk kembali ke daftar pembayaran -->
    <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>
</div>
@endsection
