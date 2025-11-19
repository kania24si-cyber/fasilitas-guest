@extends('layouts.guest.app')
@section('content')
<div class="bg-light rounded p-4">
    <h5>Edit Peminjaman</h5>

    <form action="{{ route('peminjaman.update', $peminjaman->pinjam_id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Warga</label>
            <select name="warga_id" class="form-control">
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}" {{ old('warga_id', $peminjaman->warga_id)==$w->warga_id ? 'selected' : '' }}>{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Pilih Fasilitas</label>
            <select name="fasilitas_id" class="form-control">
                @foreach($fasilitas as $f)
                    <option value="{{ $f->id }}" 
                {{ $peminjaman->fasilitas_id == $f->id ? 'selected' : '' }}>
                {{ $f->nama }} ({{ $f->jenis }})
                    </option>
                @endforeach
            </select>
            </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $peminjaman->tanggal_mulai) }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $peminjaman->tanggal_selesai) }}">
        </div>

        <div class="mb-3">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $peminjaman->tujuan) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection