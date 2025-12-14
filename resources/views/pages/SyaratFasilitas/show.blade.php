@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Syarat Fasilitas</h2>

    <div class="facility-details">
        <h3>{{ $syarat->nama_syarat }}</h3>
        <p><b>Fasilitas:</b> {{ $syarat->fasilitas->nama }}</p>
        <p><b>Deskripsi:</b> {{ $syarat->deskripsi }}</p>
    </div>

    <h4>Dokumen terkait:</h4>
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

    <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
</div>
@endsection