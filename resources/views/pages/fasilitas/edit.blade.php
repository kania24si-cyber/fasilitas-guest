@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Fasilitas Umum</h2>

    <form action="{{ route('fasilitas.update', $fasilitas->fasilitas_id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $fasilitas->nama }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="jenis" value="{{ $fasilitas->jenis }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $fasilitas->alamat }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>RT</label>
            <input type="text" name="rt" value="{{ $fasilitas->rt }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>RW</label>
            <input type="text" name="rw" value="{{ $fasilitas->rw }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" value="{{ $fasilitas->kapasitas }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $fasilitas->deskripsi }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
