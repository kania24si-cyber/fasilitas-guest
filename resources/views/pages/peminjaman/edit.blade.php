@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Peminjaman Fasilitas</h2>

    <!-- Form untuk mengedit data peminjaman fasilitas -->
    <form action="{{ route('peminjaman.update', $item->pinjam_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Method PUT untuk update data -->

        <div class="mb-3">
            <label>Nama Warga</label>
            <select name="warga_id" class="form-control">
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}" {{ $item->warga_id == $w->warga_id ? 'selected' : '' }}>{{ $w->nama }}</option>
                @endforeach
            </select>
            @error('warga_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Pilih Fasilitas</label>
            <select name="fasilitas_id" class="form-control">
                <option value="">-- Pilih Fasilitas --</option>
                @foreach($fasilitas as $f)
                    <option value="{{ $f->fasilitas_id }}" {{ $item->fasilitas_id == $f->fasilitas_id ? 'selected' : '' }}>{{ $f->nama }} ({{ $f->jenis }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $item->tanggal_mulai) }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $item->tanggal_selesai) }}">
        </div>

        <div class="mb-3">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $item->tujuan) }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ $item->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

         <!-- Form upload file -->
        <div class="mb-3">
            <label>Bukti Pembayaran (boleh banyak):</label>
            <input type="file" name="files[]" class="form-control" multiple>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
