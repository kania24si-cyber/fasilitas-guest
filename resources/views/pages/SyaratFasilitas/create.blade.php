@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Syarat Fasilitas</h2>

    <form action="{{ route('syarat_fasilitas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Upload File (boleh banyak)</label>
            <input type="file" name="files[]" class="form-control" multiple>
        </div>

        <button class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection