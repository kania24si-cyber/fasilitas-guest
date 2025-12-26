@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Syarat Fasilitas</h2>

    <form action="{{ route('syarat_fasilitas.update', $syarat->syarat_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- ================== KOLOM KIRI ================== -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Fasilitas</label>
                    <select name="fasilitas_id" class="form-control" required>
                        <option value="{{ $syarat->fasilitas_id }}">
                            {{ $syarat->fasilitas->nama }}
                        </option>
                        @foreach($fasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}">
                                {{ $f->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nama Syarat</label>
                    <input type="text"
                           name="nama_syarat"
                           value="{{ $syarat->nama_syarat }}"
                           class="form-control"
                           required>
                </div>
            </div>

            <!-- ================== KOLOM KANAN ================== -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"
                              required>{{ $syarat->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Upload File (boleh banyak)</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>
            </div>
        </div>

        <!-- ================== BUTTON ================== -->
        <div class="mt-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('syarat_fasilitas.index') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
