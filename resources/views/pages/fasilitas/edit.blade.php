@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Fasilitas Umum</h2>

    <!-- Form untuk mengedit data fasilitas dan upload file -->
    <form action="{{ route('fasilitas.update', $fasilitas->fasilitas_id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT') <!-- Method PUT untuk update data -->

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $fasilitas->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="jenis" value="{{ $fasilitas->jenis }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $fasilitas->alamat }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>RT</label>
            <input type="text" name="rt" value="{{ $fasilitas->rt }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>RW</label>
            <input type="text" name="rw" value="{{ $fasilitas->rw }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" value="{{ $fasilitas->kapasitas }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $fasilitas->deskripsi }}</textarea>
        </div>

        <!-- Form upload file -->
        <div class="mb-3">
            <label>Upload File (boleh banyak):</label>
            <input type="file" name="files[]" class="form-control" multiple>
        </div>

        <!-- Tombol untuk submit data -->
        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
