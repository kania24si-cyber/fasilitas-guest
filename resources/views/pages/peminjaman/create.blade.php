@extends('layouts.guest.app')
@section('content')
<div class="bg-light rounded p-4">
    <h5>Tambah Peminjaman</h5>

    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Warga</label>
            <select name="warga_id" class="form-control">
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>{{ $w->nama }}</option>
                @endforeach
            </select>
            @error('warga_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Pilih Fasilitas</label>
            <select name="fasilitas_id" class="form-control">
                <option value="">-- Pilih Fasilitas --</option>
                @foreach($fasilitas as $f)
                    <option value="{{ $f->id }}">{{ $f->nama }} ({{ $f->jenis }})</option>
            @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
        </div>

        <div class="mb-3">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}">
        </div>

        <div class="mb-3">
            <label>Bukti Bayar</label>
            <input type="file" name="bukti_bayar" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection