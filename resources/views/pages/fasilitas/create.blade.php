@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Fasilitas Umum</h2>

    <form action="{{ route('fasilitas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="jenis" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>

        <div class="mb-3">
            <label>RT</label>
            <input type="text" name="rt" class="form-control">
        </div>

        <div class="mb-3">
            <label>RW</label>
            <input type="text" name="rw" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
