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
            <!-- Menampilkan media berdasarkan mime_type, hanya tampilkan tombol download pertama -->
            @if($loop->first)  <!-- Hanya tampilkan untuk file pertama -->
                @if(Str::startsWith($m->mime_type, 'image'))
                    <img src="{{ asset('uploads/media/'.$m->file_name) }}" width="200" class="m-2" alt="Media">
                @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                    <!-- Tombol Download PDF -->
                    <a href="{{ asset('uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download PDF</a>
                @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                    <!-- Tombol Download DOCX -->
                    <a href="{{ asset('uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download DOCX</a>
                @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                    <!-- Tombol Download XLSX -->
                    <a href="{{ asset('uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary">Download XLSX</a>
                @else
                    <p>File tidak dikenali</p>
                @endif
            @endif
        @endforeach
    </div>

    <!-- Tombol untuk kembali ke daftar fasilitas -->
    <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>

</div>
@endsection
