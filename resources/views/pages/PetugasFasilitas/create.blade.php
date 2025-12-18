@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Petugas Fasilitas</h2>

    <form action="{{ route('petugas.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Fasilitas</label>
                    <select name="fasilitas_id" class="form-control" required>
                        <option value="">-- Pilih Fasilitas --</option>
                        @foreach($fasilitas as $f)
                        <option value="{{ $f->fasilitas_id }}">{{ $f->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Petugas (Warga)</label>
                    <select name="petugas_warga_id" class="form-control" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach($warga as $w)
                        <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Peran</label>
                    <input type="text" name="peran" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('petugas.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
