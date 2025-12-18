@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Syarat Fasilitas</h4>
        @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('syarat_fasilitas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Syarat Fasilitas
        </a>
        @endif
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama syarat..." value="{{ request('search') }}">
                    <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            @if(request()->has('search'))
            <div class="col-md-2">
                <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
            @endif
        </div>
    </form>

    {{-- Card Display --}}
    <div class="row">
        @forelse ($syaratFasilitas as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="text-primary">{{ $item->nama_syarat }}</h5>
                        <p><b>Fasilitas:</b> {{ $item->fasilitas->nama }}</p>
                        <p><b>Deskripsi:</b> {{ Str::limit($item->deskripsi, 60) }}</p>

                        <!-- Menampilkan media terkait syarat fasilitas -->
                    <h6>Dokumen Media:</h6>
                    <div class="media-list mb-3">
                        @if($item->media && $item->media->count() > 0) <!-- Cek jika ada media -->
                            @foreach($item->media as $m)
                                @if(Str::startsWith($m->mime_type, 'image'))
                                    <img src="{{ asset('storage/uploads/media/'.$m->file_name) }}" width="100" class="m-2" alt="Media">
                                @elseif(Str::startsWith($m->mime_type, 'application/pdf'))
                                    <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary btn-sm mb-1">Download PDF</a>
                                @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                                    <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary btn-sm mb-1">Download DOCX</a>
                                @elseif(Str::startsWith($m->mime_type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
                                    <a href="{{ asset('storage/uploads/media/'.$m->file_name) }}" target="_blank" class="btn btn-primary btn-sm mb-1">Download XLSX</a>
                                @else
                                    <p class="text-muted">File tidak dikenali</p>
                                @endif
                            @endforeach
                        @else
                            <p class="text-muted">Tidak ada media terkait.</p>
                        @endif
                    </div>

                        <div class="d-flex justify-content-between mt-3">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                            <!-- Tombol Detail -->
                            <a href="{{ route('syarat_fasilitas.show', $item->syarat_id) }}" class="btn btn-info btn-sm">Detail</a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('syarat_fasilitas.edit', $item->syarat_id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Tombol Hapus -->
                            <form method="POST" action="{{ route('syarat_fasilitas.destroy', $item->syarat_id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>Tidak ada data syarat fasilitas.</p>
            </div>
        @endforelse
    </div>

    {{-- Paginasi --}}
    <div class="mt-3">
        {{ $syaratFasilitas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
