@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Warga</h4>
        <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus"></i> Tambah Warga
        </a>
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="jenis_kelamin" class="form-control">
                    <option value="">-- Filter Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="agama" class="form-control">
                    <option value="">-- Filter Agama --</option>
                    <option value="Islam" {{ request('agama')=='Islam'?'selected':'' }}>Islam</option>
                    <option value="Kristen" {{ request('agama')=='Kristen'?'selected':'' }}>Kristen</option>
                    <option value="Katolik" {{ request('agama')=='Katolik'?'selected':'' }}>Katolik</option>
                    <option value="Hindu" {{ request('agama')=='Hindu'?'selected':'' }}>Hindu</option>
                    <option value="Buddha" {{ request('agama')=='Buddha'?'selected':'' }}>Buddha</option>
                    <option value="Konghucu" {{ request('agama')=='Konghucu'?'selected':'' }}>Konghucu</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama / KTP / email..." value="{{ request('search') }}">
                    <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-success w-100">Filter</button>
                @if(request()->has('search') || request()->has('jenis_kelamin') || request()->has('agama'))
                <a href="{{ route('warga.index') }}" class="btn btn-secondary w-100">Reset</a>
                @endif
            </div>
        </div>
    </form>

    <div class="row">
        @forelse ($data as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-person-fill fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                                <small class="text-muted">{{ $item->email }}</small>
                            </div>
                        </div>

                        <p class="mb-1"><strong>No KTP:</strong> {{ $item->no_ktp }}</p>
                        <p class="mb-1"><strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin }}</p>
                        <p class="mb-1"><strong>Agama:</strong> {{ $item->agama }}</p>
                        <p class="mb-1"><strong>Pekerjaan:</strong> {{ $item->pekerjaan }}</p>
                        <p class="mb-1"><strong>Telp:</strong> {{ $item->telp }}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>Belum ada data warga.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
