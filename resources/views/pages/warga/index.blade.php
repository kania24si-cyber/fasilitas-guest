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
    <div class="d-flex align-items-center gap-3">

        {{-- SEARCH --}}
        <div class="input-group" style="max-width: 250px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / KTP / email..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button> <!-- Tombol pencarian dengan ikon -->
        </div>

       {{-- FILTER JENIS KELAMIN --}}
<div style="max-width: 350px; position: relative;"> <!-- Lebarkan dropdown filter menjadi 280px -->
    <select name="jenis_kelamin" class="form-control form-control-sm">
        <option value="">Jenis Kelamin</option>
        <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
        <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
    </select>
    <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i> <!-- Icon di dalam container filter -->
</div>

{{-- FILTER AGAMA --}}
<div style="max-width: 350px; position: relative;"> <!-- Lebarkan dropdown filter menjadi 280px -->
    <select name="agama" class="form-control form-control-sm">
        <option value="">Agama</option>
        <option value="Islam" {{ request('agama')=='Islam'?'selected':'' }}>Islam</option>
        <option value="Kristen" {{ request('agama')=='Kristen'?'selected':'' }}>Kristen</option>
        <option value="Katolik" {{ request('agama')=='Katolik'?'selected':'' }}>Katolik</option>
        <option value="Hindu" {{ request('agama')=='Hindu'?'selected':'' }}>Hindu</option>
        <option value="Buddha" {{ request('agama')=='Buddha'?'selected':'' }}>Buddha</option>
        <option value="Konghucu" {{ request('agama')=='Konghucu'?'selected':'' }}>Konghucu</option>
    </select>
    <i class="bi bi-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i> <!-- Icon di dalam container filter -->
</div>


        {{-- BUTTON FILTER --}}
<div>
    <button type="submit" class="btn btn-success btn-sm">
        <i class="bi bi-funnel"></i> Filter
    </button>
</div>


        {{-- BUTTON RESET --}}
        @if(request()->has('search') || request()->has('jenis_kelamin') || request()->has('agama'))
            <div>
                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        @endif
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

                        <!-- Tombol Detail -->
                            <a href="{{ route('warga.show', $item->warga_id) }}" class="btn btn-info btn-sm btn-detail">Detail</a>
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
