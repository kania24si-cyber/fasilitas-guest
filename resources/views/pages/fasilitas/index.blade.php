@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Fasilitas Umum</h4>
        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Fasilitas
        </a>
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="jenis" class="form-control">
                    <option value="">-- Filter Jenis --</option>
                    <option value="Ruang Publik" {{ request('jenis')=='Ruang Publik'?'selected':'' }}>Ruang Publik</option>
                    <option value="Olahraga" {{ request('jenis')=='Olahraga'?'selected':'' }}>Olahraga</option>
                    <option value="Kesehatan" {{ request('jenis')=='Kesehatan'?'selected':'' }}>Kesehatan</option>
                    <option value="Pendidikan" {{ request('jenis')=='Pendidikan'?'selected':'' }}>Pendidikan</option>
                </select>
            </div>

            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama / alamat..." value="{{ request('search') }}">
                    <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Filter</button>
            </div>

            @if(request()->has('search') || request()->has('jenis'))
            <div class="col-md-2">
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
            @endif

        </div>
    </form>

    <div class="row">
        @forelse ($data as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="text-primary">{{ $item->nama }}</h5>

                        <p><b>Jenis:</b> {{ $item->jenis }}</p>
                        <p><b>Alamat:</b> {{ $item->alamat }} (RT {{ $item->rt }}/RW {{ $item->rw }})</p>
                        <p><b>Kapasitas:</b> {{ $item->kapasitas ?? '-' }}</p>
                        <p><b>Deskripsi:</b> {{ Str::limit($item->deskripsi, 60) }}</p>

                        <div class="d-flex justify-content-between">
                            <!-- Tombol Detail untuk melihat fasilitas lebih lengkap -->
                             @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('fasilitas.show', $item->fasilitas_id) }}" class="btn btn-info btn-sm">Detail</a>

                            <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form method="POST" action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Tidak ada data</p>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
