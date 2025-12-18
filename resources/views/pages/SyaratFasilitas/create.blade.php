@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Syarat Fasilitas</h2>

    <form action="{{ route('syarat_fasilitas.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label>Nama Syarat</label>
                    <input type="text" name="nama_syarat" class="form-control" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Upload File (boleh banyak)</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>

                <!-- Tombol Simpan dan Batal -->
                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
