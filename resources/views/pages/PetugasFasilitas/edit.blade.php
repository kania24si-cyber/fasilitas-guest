// resources/views/pages/petugas/edit.blade.php
@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Petugas Fasilitas</h2>

    <form action="{{ route('petugas.update', $petugas->petugas_id) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label>Fasilitas</label>
            <select name="fasilitas_id" class="form-control" required>
                <option value="{{ $petugas->fasilitas_id }}">{{ $petugas->fasilitas->nama }}</option>
                @foreach($fasilitas as $f)
                <option value="{{ $f->fasilitas_id }}">{{ $f->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Petugas (Warga)</label>
            <select name="petugas_warga_id" class="form-control" required>
                <option value="{{ $petugas->petugas_warga_id }}">{{ $petugas->petugas_warga->nama }}</option>
                @foreach($warga as $w)
                <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Peran</label>
            <input type="text" name="peran" value="{{ $petugas->peran }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
