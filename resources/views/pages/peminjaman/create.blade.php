@extends('layouts.guest.app')

@section('content')
<div class="bg-light rounded p-4">
    <h5>Tambah Peminjaman</h5>

    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Nama Warga</label>
                    <select name="warga_id" class="form-control" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>{{ $w->nama }}</option>
                        @endforeach
                    </select>
                    @error('warga_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}">
                </div>

                <div class="mb-3">
                    <label>Tujuan</label>
                    <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}">
                </div>

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui, silahkan bayar</option>
                            <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Pilih Fasilitas</label>
                    <select name="fasilitas_id" class="form-control" required>
                        <option value="">-- Pilih Fasilitas --</option>
                        @foreach($fasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>{{ $f->nama }} ({{ $f->jenis }})</option>
                        @endforeach
                    </select>
                    @error('fasilitas_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                </div>

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="mb-3">
                        <label>Upload Bukti Pembayaran (boleh banyak)</label>
                        <input type="file" name="files[]" class="form-control" multiple>
                    </div>

                    <div class="mb-3">
                        <label>Total Biaya</label>
                        <input type="text" name="total_biaya" class="form-control" value="{{ old('total_biaya') }}" placeholder="Masukkan Total Biaya">
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
