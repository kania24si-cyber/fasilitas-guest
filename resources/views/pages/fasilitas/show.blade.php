@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Fasilitas Umum</h2>

    <!-- Menampilkan data fasilitas -->
    <div class="facility-details">
        <h3>{{ $item->nama }}</h3>
        <p><b>Jenis:</b> {{ $item->jenis }}</p>
        <p><b>Alamat:</b> {{ $item->alamat }}</p>
        <p><b>RT/RW:</b> {{ $item->rt }}/{{ $item->rw }}</p>
        <p><b>Kapasitas:</b> {{ $item->kapasitas }}</p>
        <p><b>Deskripsi:</b> {{ $item->deskripsi }}</p>
    </div>

    <!-- Menampilkan media terkait fasilitas -->
    <h4>Foto/SOP Media:</h4>
    <div class="media-list">
        @foreach($media as $m)
            @if(Str::startsWith($m->mime_type, 'image'))
                <img src="{{ asset('storage/uploads/media/'.$m->file_name) }}" width="200" class="m-2" alt="Media">
            @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download PDF</a>
            @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download DOCX</a>
            @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download XLSX</a>
            @else
                <p>File tidak dikenali</p>
            @endif
        @endforeach
    </div>

    <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>

</div>
@endsection
