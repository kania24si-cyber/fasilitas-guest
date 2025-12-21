@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Syarat Fasilitas</h2>

    <form action="{{ route('syarat_fasilitas.update', $syarat->syarat_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Fasilitas</label>
                    <select name="fasilitas_id" class="form-control" required>
                        <option value="{{ $syarat->fasilitas_id }}">{{ $syarat->fasilitas->nama }}</option>
                        @foreach($fasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}">{{ $f->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nama Syarat</label>
                    <input type="text" name="nama_syarat" value="{{ $syarat->nama_syarat }}" class="form-control" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required>{{ $syarat->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Upload File (boleh banyak)</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>

                <button class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
